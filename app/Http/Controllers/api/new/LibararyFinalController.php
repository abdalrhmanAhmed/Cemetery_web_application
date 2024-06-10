<?php

namespace App\Http\Controllers\api\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// models
use App\Models\AboutTheOfficeOfCemeteriesAffair;
use App\Models\AboutTheOfficeOfCemeteriesAffairDetails;

use App\Models\DailyDeath;
use App\Models\DailyDeathsDetail;

use App\Models\Project;
use App\Models\ProjectDetails;

use App\Models\News;
use App\Models\NewsDetails;



class LibararyFinalController extends Controller
{

    // ###################################
    public function get_News()
    {
        try {
            $cemetery_sites = News::select('id', 'name', 'image')->get();
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
    public function getNewsDetails($id,$type)
    {
        try {
            $libarary = News::where('id', $id)->get();
            $data = $this->ToIntArray($libarary);
            $libarary_details = NewsDetails::whereIn('news_id', $data)->where('type', $type)->select('id', 'value')->get();
            $data = [];
            foreach ($libarary_details as $libarary_detaile) {
                $data[] = array(
                    'id'        => $libarary_detaile->id,
                    'media'      => $libarary_detaile->value ?? "",
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
    // ###############################################


    // ###################################
    public function get_Project()
    {
        try {
            $cemetery_sites = Project::select('id', 'name', 'image')->get();
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
    public function getProjectDetails($id,$type)
    {
        try {
            $libarary = Project::where('id', $id)->get();
            $data = $this->ToIntArray($libarary);
            $libarary_details = ProjectDetails::whereIn('project_id', $data)->where('type', $type)->select('id', 'value')->get();
            $data = [];
            foreach ($libarary_details as $libarary_detaile) {
                $data[] = array(
                    'id'        => $libarary_detaile->id,
                    'media'      => $libarary_detaile->value ?? "",
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
    // ###############################################


    // ###################################
    public function getAboutTheOfficeOfCemeteriesAffair()
    {
        try {
            $cemetery_sites = AboutTheOfficeOfCemeteriesAffair::select('id', 'name', 'image')->get();
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
    public function getAboutTheOfficeOfCemeteriesAffairDetails($id,$type)
    {
        try {
            $libarary = AboutTheOfficeOfCemeteriesAffair::where('id', $id)->get();
            $data = $this->ToIntArray($libarary);
            $libarary_details = AboutTheOfficeOfCemeteriesAffairDetails::whereIn('news_id', $data)->where('type', $type)->select('id', 'value')->get();
            $data = [];
            foreach ($libarary_details as $libarary_detaile) {
                $data[] = array(
                    'id'        => $libarary_detaile->id,
                    'media'      => $libarary_detaile->value ?? "",
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
    // ###############################################



    // ###################################
    public function getDailyDeath()
    {
        try {
            $cemetery_sites = DailyDeath::select('id', 'name', 'image')->get();
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
    // ###############################################










    // zero codes
    public function ToIntArray($data){
        $array = array();
        foreach($data as $item){
            $array[] = intval($item['id']);

        }
        return $array;
    }
}
