<?php

namespace App\Http\Controllers\Site;

use App\Http\Token\XWSSE;
use Illuminate\Http\Request;

class ProfileController extends BaseSiteController
{
    public function index()
    {
        $xwsse = app(XWSSE::class);
        $xwsse::generateXwsse();
    }
}
