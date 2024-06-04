<?php

namespace App\Http\Controllers\api\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// models
use App\Models\CemeterySites;
use App\Models\CemeterySitesContact;
use App\Models\CemeterySitesDetails;

class CemeterySiteController extends Controller
{
    public function get_cemetery_sites()
    {
        try {
            $cemetery_sites = CemeterySites::select('id', 'name', 'image')->get();
            $data = [];
            foreach ($cemetery_sites as $cemetery_site) {
                $data[] = array(
                    'id' => $cemetery_site->id,
                    'name' => $cemetery_site->name,
                    'image' => $cemetery_site->image,
                );
            }
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

    public function get_cemetery_detail($id)
    {
        try 
        {
            $cemetery_site = CemeterySites::where('id', $id)->select('id', 'name', 'latitude', 'longitude')->first();
            $data = array(
                    'id'        => $cemetery_site->id,
                    'name'        => $cemetery_site->name,
                    'text'        => "cemetery_site->text",
                    'lat'        => $cemetery_site->latitude,
                    'long'        => $cemetery_site->longitude,
                );
            $response = array(
                'error' => false,
                'message' => trans('Get Data Successfuly'),
                'data' => $data,
                'code' => 200,
            );
        } 
        catch (\Exception $e) 
        {
            return $e;
            $response = array(
                'error' => true,
                'message' => trans('error_occurred'),
                'code' => 103,
            );
        }
        return response()->json($response);
    }



    public function get_cemetery_site(Request $request)
    {
        try {
            $cemetery_site = CemeterySites::where('id', $request->id)->get();
            $data = $this->ToIntArray($cemetery_site);
            $cemetery_site_details = CemeterySitesDetails::whereIn('cemetery_sites_id', $data)->where('status', 1)->select('id', 'type', 'value')->get();
            $data = [];
            foreach ($cemetery_site_details as $cemetery_site) {
                $data[] = array(
                    'id'        => $cemetery_site->id,
                    'type'      => $cemetery_site->type ?? "",
                    'value'     => $cemetery_site->value ?? ""
                );
            }
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


    // zero codes
    public function ToIntArray($data){
        $array = array();
        foreach($data as $item){
            $array[] = intval($item['id']);

        }
        return $array;
    }}
