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

            toastr()->success(__('Data has been saved successfully!'));
            return redirect()->route('cemetery.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery.index');
        }
    }

    public function edit($id)
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
        $countries = Country::all();
        $cemeterie = Cemetery::findOrFail($id);
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

            toastr()->success(__('Data has been Updated successfully!'));
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
            $blocks = Block::where('cemetery_id', $id)->get();
            if($blocks)
            {
                toastr()->error(__('There Is Block Belongs To This Cemetery !'));
            }else{$Cemetery->delete();}


            toastr()->success(__('Data has been Deleted successfully!'));
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
        $cities = City::where('country_id', $id)->pluck('name', 'id');
        return $cities;
    }
}
