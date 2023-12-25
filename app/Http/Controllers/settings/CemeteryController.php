<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Cemetery;

class CemeteryController extends Controller
{
    public function index()
    {
        $cemeteries = Cemetery::all();
        return view('settings.cemeteries.index',compact('cemeteries'));    
    }
}
