<?php


namespace App\Http\Token;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Http;

class XWSSE implements Authenticatable
{
    private $user;
    private $token;

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function get($email, $password)
    {
        $url = env("XWSSE_URL");
        $this->user = $email;

        $response = Http::asForm()->post($url, [
            'user' => $email,
            'pass' => $password,
        ]);

        $this->handleResponse($response);
        return $this;
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

            $this->token = $arr["token"];
        }
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