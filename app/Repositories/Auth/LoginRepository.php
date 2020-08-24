<?php

namespace App\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Auth\Authenticatable;

class LoginRepository extends CoreRepository
{
    /**
     * @param string $email
     * @param string $password
     * @return Authenticatable $this->authObj;
     */
    public function getUserToken($email, $password)
    {
        $url = "http://api.japancar.ru/token";
        $this->authObj->setUser($email);

        try{
            $response = Http::asForm()->post($url, [
                'user' => $email,
                'pass' => $password,
            ]);
        } catch (ConnectionException $e) {
            $this->authObj->error["other"] = "Сервис временно не доступен!";
            return $this->authObj;
        }

        $this->handleResponse($response);
        return $this->authObj;
    }
}