<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class localizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function setLang($locale)
    {
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }

}
