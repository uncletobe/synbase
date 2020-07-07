<?php


namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

abstract class BaseSiteController extends Controller
{
    public function __construct()
    {
//        $this->middleware("auth");
    }
}