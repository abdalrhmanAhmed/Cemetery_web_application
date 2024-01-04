<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Cemetery;
use App\Models\Grave;

class CemeteryController extends Controller
{
    public function index()
    {
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 25.1338688,
                    'lng' => 56.3332739
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        $cemeteries = Cemetery::all();
        $countries = Country::all();
        return view('settings.cemeteries.index',compact('cemeteries', 'countries', 'initialMarkers'));    
    }

    public function store(Request $request)
    {
        try 
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'city_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            $cemetery = new Cemetery();
            $cemetery->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $cemetery->citiy_id = $request->city_id;
            $cemetery->latitude = $request->latitude;
            $cemetery->Longitude = $request->longitude;
            $cemetery->save();

            return redirect()->route('cemetery.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    public function edit($id)
    {
        $countries = Country::all();
        $cemeterie = Cemetery::findOrFail($id);
        $initialMarkers = [
            [
                'position' => [
                    'lat' => floatval($cemeterie->latitude),
                    'lng' => floatval($cemeterie->Longitude)
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        return view('settings.cemeteries.editCemetery', compact('cemeterie', 'initialMarkers', 'countries'));
    }

    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'city_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            $cemetery = Cemetery::findOrFail($id);
            $cemetery->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $cemetery->citiy_id = $request->city_id;
            $cemetery->latitude = $request->latitude;
            $cemetery->Longitude = $request->longitude;
            $cemetery->save();

            return redirect()->route('cemetery.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    public function destroy($id)
    {
        try 
        {
            $Cemetery = Cemetery::findOrFail($id);
            $blocks = Block::where('cemetery_id', $id)->get();
            if($blocks)
            {
                return redirect()->route('cemetery.index')->with(['error' => __('There Is Block Belongs To This Cemetery !')]);
            }else{$Cemetery->delete();}


            return redirect()->route('cemetery.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    // ajax
    public function getCity($id)
    {
        $cities = City::where('country_id', $id)->pluck('name', 'id');
        return $cities;
    }
}
