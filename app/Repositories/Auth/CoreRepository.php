<?php


namespace App\Repositories;

use App\Http\Token\AuthObject;
use Illuminate\Http\Client\Response;
use App\Utils\Utils;
use Illuminate\Support\MessageBag as Errors;

class CoreRepository
{
    protected $authObj = null;

    public function __construct()
    {
        $this->authObj = new AuthObject();
    }

    /**
     * @param $res Response
     * @return string
     */
    public function handleResponse(Response $res)
    {
        $statusCode = $res->status();
        $content = $res->body();
        $errors = new Errors();

        if ($statusCode == 200) {
            $arr = Utils::getValidJsonFromApi($content);

//            $role = $arr["roles"];
//            $role = "default";

            if (!empty($arr["roles"]) && (in_array($arr["roles"][0], \Config::get("roles.available")))) {
                $this->authObj->setRole($arr["roles"][0]);
            } else {
                $this->authObj->error["other"] = "Доступ запрещен!";
            }

            if (isset($arr["available_login"])) {
               $this->authObj->error["other"] = "Такой email уже занят, наверное вы регистрировались раньше. <br>Попробуйте <a href='/reset' class='link-underline-danger'>восстановить пароль</a>.";
               return false;
            }

            if (!empty($arr["token"])) {
                $this->authObj->setToken($arr["token"]);
                return true;
            }
            $this->authObj->error["other"] = "Неверное имя пользователя или пароль!";
        }
    }

}