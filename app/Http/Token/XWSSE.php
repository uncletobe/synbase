<?php


namespace App\Http\Token;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Http;

class XWSSE implements Authenticatable
{
    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function get($email, $password)
    {
        $url = env("XWSSE_URL");

        $response = Http::asForm()->post($url, [
            'user' => $email,
            'pass' => $password,
        ]);

        return $this->handleResponse($response);
    }

    /**
     * @param $res Illuminate\Support\Facades\Http;
     * @return string
     */
    private function handleResponse($res)
    {
        $statusCode = $res->status();
        $content = $res->body();

        if ($statusCode == 200) {
            $arr = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content), true );

            return $arr["token"];
        }
    }

    public static function login()
    {

    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        // TODO: Implement getAuthIdentifier() method.
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}