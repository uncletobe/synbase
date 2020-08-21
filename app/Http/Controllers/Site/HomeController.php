<?php

namespace App\Http\Controllers\Site;
use TwigBridge\Facade\Twig;

class HomeController extends BaseSiteController
{
    public function index()
    {
        return view("site.index");
    }
}
