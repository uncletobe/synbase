<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Token\XWSSE;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("site.login");
    }

    public function singIn(LoginRequest $request)
    {
        $data = $request->input();
        $xwsse = new XWSSE($data);

        $token = $xwsse->get($data["email"], $data["password"]);

        if (!empty($token)) {
            \Auth::login($token);
            return redirect("/");
        }
    }

}
