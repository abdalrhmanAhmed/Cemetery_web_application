<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('new.Setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_google(Request $request)
    {
        $job = $this->settingStore('google_key', $request->google_key);
        if ($job == true) 
        {
            return redirect()->route('Setting.index')->with(['success' => __('Data has been saved successfully!')]);
        }
        else 
        {
            return redirect()->route('Setting.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

        public function store_android(Request $request)
    {
        $job = $this->settingStore('android_url', $request->android_url);
        if ($job == true) 
        {
            return redirect()->route('Setting.index')->with(['success' => __('Data has been saved successfully!')]);
        }
        else 
        {
            return redirect()->route('Setting.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

        public function store_ios(Request $request)
    {
        $job = $this->settingStore('ios_url', $request->ios_url);
        if ($job == true) 
        {
            return redirect()->route('Setting.index')->with(['success' => __('Data has been saved successfully!')]);
        }
        else 
        {
            return redirect()->route('Setting.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }




    

    private function settingStore($key_name, $value)
    {
        $stteing = Setting::where('key',$key_name)->get();
        if ($stteing->count() == 0) 
        {
            $stteing = new Setting();
            $stteing->key = $key_name;
            $stteing->value = $value;
            $stteing->save();
        }
        else 
        {
            $stteing = Setting::where('key',$key_name)->first();
            $stteing->key = $key_name;
            $stteing->value = $value;
            $stteing->save();
        }
        return true;
    }
}
