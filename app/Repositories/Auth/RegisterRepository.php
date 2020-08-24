<?php

namespace App\Repositories;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;


class RegisterRepository extends CoreRepository
{

    const REGISTRATION_URL = "api.japancar.ru/reg";

    /**
     * @param string $email
     * @param string $password
     * @return Authenticatable $this->authObj;
     */
    public function serverRequest($email, $password)
    {
        $this->authObj->setUser($email);

        try {
            $response = Http::asForm()->post(self::REGISTRATION_URL, [
                'email' => $email,
                'password' => $password,
            ]);
        } catch (ConnectionException $e) {
            $this->authObj->error["other"] = "Сервис временно не доступен!";
            return $this->authObj;
        }

        $this->handleResponse($response);
        return $this->authObj;
    }

}