<?php

namespace App\Http\Controllers\api\new;

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

use App\Models\Library;
use App\Models\LibraryDetail;



class LibararyController extends Controller
{
    public function get_libarares()
    {
        try {
            $libarares = Library::select('id', 'name', 'image')->get();
            $data = [];
            foreach ($libarares as $libarary) {
                $data[] = array(
                    'id' => $libarary->id,
                    'name' => $libarary->name,
                    'image' => $libarary->image,
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

    public function get_libarary(Request $request)
    {
        try {
            $libarary = Library::where('id', $request->id)->get();
            $data = $this->ToIntArray($libarary);
            $libarary_details = LibraryDetail::whereIn('library_id', $data)->select('id', 'text', 'image', 'video', 'voice')->get();
            $data = [];
            foreach ($libarary_details as $libarary_detaile) {
                $data[] = array(
                    'id'        => $libarary_detaile->id,
                    'text'      => $libarary_detaile->text ?? "",
                    'image'     => $libarary_detaile->image ?? "",
                    'video'     => $libarary_detaile->video ?? "",
                    'voice'     => $libarary_detaile->voice ?? "",
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
    }
}
