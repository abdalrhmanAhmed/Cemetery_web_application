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


    
    public function store_push_notification(Request $request)
    {
        $job    = $this->settingStore('firebase_cloud_messaging_key', $request->firebase_cloud_messaging_key);
        $job1   = $this->settingStore('api_key', $request->api_key);
        $job2   = $this->settingStore('auth_domain', $request->auth_domain);
        $job3   = $this->settingStore('database_url', $request->database_url);
        $job4   = $this->settingStore('project_iD', $request->project_iD);
        $job5   = $this->settingStore('storage_bucket', $request->storage_bucket);
        $job6   = $this->settingStore('messaging_sender_id', $request->messaging_sender_id);
        $job7   = $this->settingStore('application_id', $request->application_id);
        $job8   = $this->settingStore('measurement_id', $request->measurement_id);
        if ($job == true && $job1 == true && $job2 == true && $job3 == true && $job4 == true && $job5 == true && $job6 == true && $job7 == true && $job8 == true) 
        {
            return redirect()->route('Setting.index')->with(['success' => __('Data has been saved successfully!')]);
        }
        else 
        {
            return redirect()->route('Setting.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }


    public function store_mail(Request $request)
    {
        $job2   = $this->settingStore('mail_host', $request->mail_host);
        $job3   = $this->settingStore('mail_port', $request->mail_port);
        $job4   = $this->settingStore('mail_encryption', $request->mail_encryption);
        $job5   = $this->settingStore('username', $request->username);
        $job6   = $this->settingStore('mail_password', $request->mail_password);
        $job7   = $this->settingStore('sender_email', $request->sender_email);
        $job8   = $this->settingStore('sender_name', $request->sender_name);
        if ($job2 == true && $job3 == true && $job4 == true && $job5 == true && $job6 == true && $job7 == true && $job8 == true) 
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
