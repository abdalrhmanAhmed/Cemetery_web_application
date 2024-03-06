<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// models
use App\Models\Information;
use App\Models\Cemetery;
use App\Models\Country;
use App\Models\Block;
use App\Models\Grave;
use App\Models\City;
use App\Models\BurialExcel;

class CemeteryController extends Controller
{
    public function get_country()
    {
        try {
            $countries = Country::select('id', 'name')->get();
            $data = [];
            foreach ($countries as $country) {
                $data[] = array(
                    'id' => $country->id,
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
            $cemeteries = Cemetery::whereIn('citiy_id', $data)->select('id', 'name', 'citiy_id')->get();
            $data = [];
            foreach ($cemeteries as $cemetery) {
                $data[] = array(
                    'id'        => $cemetery->id,
                    'name'      => $cemetery->name,
                    'city'      => $cemetery->cities->name ?? "",
                    'country'   => $cemetery->cities->countries->name ?? "",
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
                $data = array(
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
            $cemeteries = Cemetery::where('id', $id)->select('id', 'name')->first();
            $graves = BurialExcel::where('Cemetery_N', 'LIKE', '%'. $cemeteries->name .'%')->get();
            // $blocks = Block::where('cemetery_id', $cemeteries->id)->select('id', 'name')->get();
            // $data = $this->ToIntArray($blocks);
            // $graves = Grave::whereIn('block_id', $data)->where('status', 1)->select('id', 'name')->get();
            // $data = [];
            foreach ($graves as $grave) {
                $data[] = array(
                    'id'       => $grave->Grave_Code,
                    'name'     => $grave->Name ,
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

    public function get_grave_details($id)
    {
        try {
            $grave = BurialExcel::where('Grave_Code', $id)->first();
            $data = [];
            $data[] = array(
                'id'                    => $grave->Grave_Code,
                'name'                  => $grave->Grave_Co_1,
                'dead_name'             => $grave->Name ,
                'date_of_death'         => $grave->Date_Of_De,
                'burial_date'           => $grave->Burial_Dat,
                'cemetery_name'         => $grave->Cemetery_N ?? "",
                'medical_diagnosis'     => $grave->Hospital_R ?? "",
                'hospital_name'         => $grave->Hospital ?? "",
                'city'                  => $grave->Emirates ?? "",
                'country'               => $grave->Country ?? "",
                'latitude'              => $grave->X,
                'Longitude'             => $grave->Y
            );
            $response = array(
                'error' => false,
                'message' => "تم تحميل البيانات بنجاح",
                'data' => $data,
                'code' => 200,
            );
        } catch (\Exception $e) {
            return $e;
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }

    public function get_graves()
    {
        try {
            $graves = BurialExcel::get();
            $data = [];
            foreach ($graves as $grave) {
                $data[] = array(
                    'id'                    => $grave->Grave_Code,
                    'name'                  => $grave->Grave_Co_1,
                    'dead_name'             => $grave->Name ,
                    'date_of_death'         => $grave->Date_Of_De,
                    'burial_date'           => $grave->Burial_Dat,
                    'cemetery_name'         => $grave->Cemetery_N ?? "",
                    'medical_diagnosis'     => $grave->Hospital_R ?? "",
                    'hospital_name'         => $grave->Hospital ?? "",
                    'city'                  => $grave->Emirates ?? "",
                    'country'               => $grave->Country ?? "",
                    'latitude'              => $grave->X,
                    'Longitude'             => $grave->Y
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
