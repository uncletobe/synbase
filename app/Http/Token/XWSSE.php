<?php


namespace App\Http\Token;

use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class XWSSE implements Authenticatable
{
    private $user = null;
    private $token = null;
    public $error = null;

    /**
     * @param string $email
     * @param string $password
     * @return Authenticatable $this
     */
    public function get($email, $password)
    {
        $url = env("XWSSE_URL");
        $this->user = $email;

        try{
            $response = Http::asForm()->post($url, [
                'user' => $email,
                'pass' => $password,
            ]);
        } catch (ConnectionException $e) {
            $this->error = "Сервис временно не доступен!";
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
            $arr = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content), true );

            if (!empty($arr["token"])) {
                $this->token = $arr["token"];
                return true;
            }
            $this->error = "Неверное имя пользователя или пароль!";
        }
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