<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\RegisterRepository;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view("site.auth.reg");
    }


    public function registration(LoginRequest $request, RegisterRepository $registerRepository)
    {
        $data = $request->input();
        $authObj = $registerRepository->serverRequest($data["email"], $data["password"]);
        
        if (empty($authObj->error)) {
            Auth::login($authObj);
            return redirect("/");
        }

        return back()
            ->withErrors($authObj->error)
            ->withInput();
    }
}
