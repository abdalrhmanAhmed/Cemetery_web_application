<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// models
use App\Models\Cemetery;
use App\Models\Country;
use App\Models\Grave;
use App\Models\City;

class CemeteryController extends Controller
{
    public function get_country()
    {
        try {
            $countries = Country::get();
            $data = [];
            foreach ($countries as $country) {
                $data[] = array(
                    'name' => $country->name,
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
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

    public function get_cemetery($id)
    {
        try {
            $cities = City::where('country_id', $id)->get('id');
            $data = $this->ToIntArray($cities);
            $cemeteries = Cemetery::whereIn('citiy_id', $data)->select('id', 'name')->get();
            $data = [];
            foreach ($cemeteries as $cemetery) {
                $data[] = array(
                    'id'        => $cemetery->id,
                    'name'      => $cemetery->name,
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
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

    public function get_cemetery_details($id)
    {
        try {
            $cemeteries = Cemetery::where('id', $id)->select('id', 'name', 'latitude', 'Longitude')->get();
            $data = [];
            foreach ($cemeteries as $cemetery) {
                $data[] = array(
                    'id'        => $cemetery->id,
                    'name'      => $cemetery->name,
                    'latitude'  => $cemetery->latitude,
                    'Longitude' => $cemetery->Longitude
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
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

    public function get_all_grave($id)
    {
        try {
            return $graves = Grave::where('id', $id)->select('id', 'name')->get();
            $data = [];
            foreach ($graves as $grave) {
                $data[] = array(
                    'id'        => $grave->id,
                    'name'      => $grave->name,
                    // 'latitude'  => $grave->latitude,
                    // 'Longitude' => $grave->Longitude
                );
            }
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
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


    // zero codes
    public function ToIntArray($data){
        $array = array();
        foreach($data as $item){
            $array[] = intval($item['id']);

        }
        return $array;
    }
}
