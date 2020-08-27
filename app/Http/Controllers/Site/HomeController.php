<?php

namespace App\Http\Controllers\Site;

use App\Emulate\Synonyms;

class HomeController extends BaseSiteController
{
    public function index(Synonyms $synonymsClass)
    {
        $synonyms = $synonymsClass->getFromDB();
        return view("site.index", compact("synonyms"));
    }
}
