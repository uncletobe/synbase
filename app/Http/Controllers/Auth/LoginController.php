<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\TokenHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view("site.login");
    }

    public function singIn(LoginRequest $request)
    {
        $data = $request->input();
        $token = new TokenHelper($data);
    }
}
