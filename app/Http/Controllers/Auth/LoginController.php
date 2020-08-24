<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\LoginRepository;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect("/");
        }
        return view("site.auth.login");
    }

    public function singIn(LoginRequest $request, LoginRepository $loginRepository)
    {
        $data = $request->input();
        $authObj = $loginRepository->getUserToken($data["email"], $data["password"]);

        if (empty($authObj->error)) {
            Auth::login($authObj);
            return redirect("/");
        }

        return back()
            ->withErrors($authObj->error)
            ->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }

}
