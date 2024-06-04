<?php

namespace App\Http\Controllers\api\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// models

use App\Models\Setting;



class SettingController extends Controller
{

    public function get_setting($key)
    {
        try {
            $setting = Setting::where('key', $key)->first();
            $data = array(
                'id'        => $setting->id,
                'key'      => $setting->key ?? "",
                'value'     => $setting->value ?? "",
            );
            $response = array(
                'error' => false,
                'message' => trans('Get Data Successfuly'),
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }
}
