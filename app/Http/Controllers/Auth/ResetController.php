<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetRequest;
use App\Repositories\Auth\RestoreRepository;

class ResetController extends Controller
{
    public function index()
    {
        return view("site.auth.reset");
    }

    public function restore(ResetRequest $request, RestoreRepository $restoreRepository)
    {
        $data = $request->input();

        $error = $restoreRepository->serverRequest($data["email"]);

        if (empty($error)) {
            \Session::flash("info", "Новый пароль выслан на почту " . $data["email"]);
            \Session::flash("alert-class", "alert-success");

            return redirect("login")
                ->withInput($data);
        }

        return back()
            ->withErrors($error)
            ->withInput();
    }
}
