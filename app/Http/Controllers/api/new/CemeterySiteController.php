<?php

namespace App\Http\Controllers\api\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// models
use App\Models\BurialExcel;
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
            $cemetery_site = CemeterySites::where('id', $id)->select('id', 'text', 'name', 'latitude', 'longitude')->first();
            $data = array(
                    'id'        => $cemetery_site->id,
                    'name'        => $cemetery_site->name,
                    'text'        => $cemetery_site->text,
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



    public function get_cemetery_site($id, $type)
    {
        try {
            $cemetery_site = CemeterySites::where('id', $id)->get();
            $data = $this->ToIntArray($cemetery_site);
            $cemetery_site_details = CemeterySitesDetails::whereIn('cemetery_sites_id', $data)->where('type', $type)->where('status', 1)->select('id', 'type', 'value')->get();
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


    public function get_cemetery_site_contact($id)
    {
        try {
            $cemetery_site = CemeterySites::where('id', $id)->get();
            $data = $this->ToIntArray($cemetery_site);
            $cemetery_site_details = CemeterySitesContact::whereIn('cemetery_sites_id', $data)->select('id', 'type', 'value')->get();
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



    }





    public function index(Request $request)
    {
        // Fetch the last 10 records
        $records = BurialExcel::take(10)->select(
            'id',
            'emirates_id',
            'name', 
            'gender', 
            'nationality', 
            'cause_of_death', 
            'date_of_death', 
            'hospital', 
            'burial_date', 
            'cemetery_name', 
            'shahed_number'
        )->get();;
        return response()->json($records);
    }

    public function search(Request $request)
    {
        // Fetch records based on search query and pagination
        $query = BurialExcel::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('emirates_id', 'like', "%{$search}%")
                  ->orWhere('date_of_death', 'like', "%{$search}%")
                  ->orWhere('burial_date', 'like', "%{$search}%")
                  ->orWhere('shahed_number', 'like', "%{$search}%")
                  ->orWhere('cemetery_name', 'like', "%{$search}%")->select('id', 'emirates_id', 'name', 'gender', 'nationality', 'cause_of_death', 'date_of_death', 'hospital', 'burial_date', 'cemetery_name', 'shahed_number')->get();
        }

        $records = $query->latest()->paginate(10);
        return response()->json($records);
    }

    public function get_grave($id)
    {
        try{
            $record = BurialExcel::where('id',$id)->select('id', 'emirates_id', 'name', 'cemetery_name', 'northing','easting','elevation')->first();               
            $response = array(
                'error' => false,
                'message' => trans('Get Data Successfuly'),
                'data' => $record,
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


//  LatLng parseDms(String dmsString) {
//     final dmsPattern = RegExp(
//         r'(\d+)° (\d+)\u0027 (\d+\.\d+)" ([NSEW]) (\d+)° (\d+)\u0027 (\d+\.\d+)" ([NSEW])');
//     final match = dmsPattern.firstMatch(dmsString);

//     if (match == null) {
//       throw FormatException('Invalid DMS string');
//     }

//     final lat = dmsToDd(
//       int.parse(match.group(1)!),
//       int.parse(match.group(2)!),
//       double.parse(match.group(3)!),
//       match.group(4)!,
//     );

//     final long = dmsToDd(
//       int.parse(match.group(5)!),
//       int.parse(match.group(6)!),
//       double.parse(match.group(7)!),
//       match.group(8)!,
//     );

//     return LatLng(lat, long);
//   }




