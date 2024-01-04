<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Cemetery;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $cities = City::all();
        return view('settings.cities.index', compact('countries','cities'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'country_id' => 'required',
            ]);
            $cities = new City();
            $cities->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $cities->country_id	 = $request->country_id;
            $cities->save();

            return redirect()->route('city.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e)
        {
            return redirect()->route('city.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }


    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'country_id' => 'required',
            ]);
            
            $cities = City::findOrFail($id);
            $cities->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $cities->country_id	 = $request->country_id;
            $cities->save();

            return redirect()->route('city.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('city.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try 
        {
            $cemetery = Cemetery::where('citiy_id', $id)->get();
            if($cemetery)
            {
                return redirect()->route('city.index')->with(['error' => __('You Can`t Delete This City Because There Is Cemeteries Belongs To It')]);
            }else{City::destroy($id);}
            
            return redirect()->route('city.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('city.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
