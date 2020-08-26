<?php


namespace App\Repositories\Auth;


use App\Utils\Utils;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class RestoreRepository
{
    public $error = null;

    /**
     * @param $email
     * @return string error
     */
    public function serverRequest($email)
    {
        $url = "api.japancar.ru/rem";

        try{
            $response = Http::asForm()->post($url, [
                'email' => $email,
            ]);
        } catch (ConnectionException $e) {
            $this->error["other"] = "Сервис временно не доступен!";
            return $this->error;
        }

        $this->handleResponse($response);
        return $this->error;
    }

    /**
     * @param $res Response
     * @return string
     */
    public function handleResponse($res)
    {
        $statusCode = $res->status();
        $content = $res->body();

        if ($statusCode == 200) {
            $arr = json_decode($content, true);

            if (!empty($arr["msg"])) $this->error["other"] = "Пользователя с таким email не существует!";
        }
    }
}