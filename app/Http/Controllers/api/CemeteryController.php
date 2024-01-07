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
            $blocks = Block::where('cemetery_id', $cemeteries->id)->select('id', 'name')->get();
            $data = $this->ToIntArray($blocks);
            $graves = Grave::whereIn('block_id', $data)->select('id', 'name')->get();
            $data = [];
            foreach ($graves as $grave) {
                $data[] = array(
                    'id'       => $grave->id,
                    'name'     => $grave->name,
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
            $grave = Grave::where('id', $id)->select('id', 'name')->first();
            $infos = Information::where('grave_id', $id)->first();
            $data = [];
            $data[] = array(
                'id'                    => $grave->id,
                'name'                  => $grave->name,
                'dead_name'             => $infos->deceased->name . ' ' . $infos->deceased->father . ' ' . $infos->deceased->grand_father . ' ' . $infos->deceased->great_grand_father,
                'date_of_death'         => $infos->date_of_death,
                'burial_date'           => $infos->burial_date,
                'cemetery_name'         => $infos->graves->blocks->cemeteries->name ?? "",
                'city'                  => $infos->graves->blocks->cemeteries->cities->name ?? "",
                'country'               => $infos->graves->blocks->cemeteries->cities->countries->name ?? "",
                'latitude'              => 25.1338688,
                'Longitude'             => 56.33327390000002
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
            $graves = Information::get();
            $data = [];
            foreach ($graves as $grave) {
                $data[] = array(
                    'id'       => $grave->graves->id,
                    'dead_name'     => $grave->deceased->name.' '.$grave->deceased->father.' '.$grave->deceased->grand_father.' '.$grave->deceased->great_grand_father,
                    'date_of_death' => $grave->date_of_death ?? "" ,
                    'burial_date' => $grave->burial_date ?? "",
                    'cemetery_name' => $grave->graves->blocks->cemeteries->name ?? "",
                    'city' => $grave->graves->blocks->cemeteries->cities->name ?? "",
                    'country' => $grave->graves->blocks->cemeteries->cities->countries->name ?? "",
                    'latitude' => $grave->graves->latitude ?? "",
                    'Longitude' => $grave->graves->Longitude ?? ""
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
