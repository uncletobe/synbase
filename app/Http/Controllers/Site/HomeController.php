<?php

namespace App\Http\Controllers\Site;

class HomeController extends BaseSiteController
{
    public function index()
    {
        return view("site.home");
    }
}
