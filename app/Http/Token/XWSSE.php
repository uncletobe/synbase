<?php


namespace App\Http\Token;

use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class XWSSE implements Authenticatable
{
    const XWSSE_URL="http://api.japancar.ru/token";
    private $user = null;
    private $token = null;
    private $role = null;
    public $error = null;

    /**
     * @param string $email
     * @param string $password
     * @return Authenticatable $this
     */
    public function get($email, $password)
    {
        $url = self::XWSSE_URL;
        $this->user = $email;

        try{
            $response = Http::asForm()->post($url, [
                'user' => $email,
                'pass' => $password,
            ]);
        } catch (ConnectionException $e) {
            $this->error["other"] = "Сервис временно не доступен!";
            return $this;
        }

        $this->handleResponse($response);
        return $this;
    }

    /**
     * @param $res Response
     * @return string
     */
    private function handleResponse($res)
    {
        $statusCode = $res->status();
        $content = $res->body();

        if ($statusCode == 200) {
            $arr = self::getValidJsonFromApi($content);

            if (!empty($arr["roles"])) $this->role =  $arr["roles"][0];
            $this->role = "default";

            if (!empty($arr["token"])) {
                $this->token = $arr["token"];
                return true;
            }
            $this->error["other"] = "Неверное имя пользователя или пароль!";
        }
    }

    public static function generateXwsse()
    {
        $url = "http://api.japancar.ru/profile";
        $user = \Auth::user();
        $token = \Auth::token();
        $nonce = \Str::random(mt_rand(6, 12));

        $t = explode(" ", microtime());
        $dateFormat = 'Y-m-d H:i:s';
        $time = date($dateFormat, $t[1]).substr((string)$t[0],1,3);

        $digest = base64_encode(sha1($nonce . $time . $token, true));

        try {
            $response = Http::withHeaders([
                'X-WSSE' => 'X-WSSE: UsernameToken Username="'. $user .'", PasswordDigest="'. $digest
            .'", Nonce="'. $nonce .'", Created="'. $time . '"',
            ])->post($url);

        } catch (ConnectionException $e) {
            dd($e);
        }

        $res = $response->body();
        $result = self::getValidJsonFromApi($res);
    }

    /**
     * @param $json
     * @return array
     */
    public static function getValidJsonFromApi($json) {
        return json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true );
    }

    /**
     * @return string|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string|null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param string $token
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName(){}

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->token;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(){}

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken(){}

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     * @return void
     */
    public function setRememberToken($value){}

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName(){}

}