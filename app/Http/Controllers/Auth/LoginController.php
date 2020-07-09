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
        if (Auth::check()) {
            return redirect("/");
        }
        return view("site.login");
    }

    public function singIn(LoginRequest $request)
    {
        $data = $request->input();
        $xwsse = new XWSSE();
        $objXwsse = $xwsse->get($data["email"], $data["password"]);

        if (empty($objXwsse->error)) {
            Auth::login($objXwsse);
            return redirect("/");
        }
        return back()
            ->withErrors($objXwsse->error)
            ->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }

}
