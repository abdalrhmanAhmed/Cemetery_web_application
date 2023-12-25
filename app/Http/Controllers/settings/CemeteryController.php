<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Cemetery;

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
            $cemetery = new Cemetery();
            $cemetery->name = $request->name;
            $cemetery->citiy_id = $request->city_id;
            $cemetery->latitude = $request->latitude;
            $cemetery->Longitude = $request->longitude;
            $cemetery->save();

            return redirect()->route('cemetery.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery.index');
        }
    }

    public function update(Request $request, $id)
    {
        try 
        {
            $cemetery = Cemetery::findOrFail($id);
            $cemetery->name = $request->name;
            // $cemetery->citiy_id = $request->city_id;
            $cemetery->latitude = $request->latitude;
            $cemetery->Longitude = $request->longitude;
            $cemetery->save();

            return redirect()->route('cemetery.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery.index');
        }
    }

    public function destroy($id)
    {
        try 
        {
            $Cemetery = Cemetery::findOrFail($id);
            $Cemetery->delete();

            return redirect()->route('cemetery.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery.index');
        }
    }

    // ajax
    public function getCity($id)
    {
        $cities = City::where('country_id', $id)->pluck('id', 'name');
        return $cities;
    }
}
