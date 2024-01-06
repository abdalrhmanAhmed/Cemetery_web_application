<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('settings.country.index', compact('countries'));
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
            ]);
            $countries = new Country();
            $countries->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $countries->save();

            return redirect()->route('country.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e)
        {
            return redirect()->route('country.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);

            $countries = Country::findOrFail($id);
            $countries->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $countries->save();

            return redirect()->route('country.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('country.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $city = City::where('country_id', $id)->get();
            if($city)
            {
                return redirect()->route('country.index')->with(['error' => __('You Can`t Delete This Country Because There Is Cities Belongs To It')]);
            }else{Country::destroy($id);}
            
            return redirect()->route('country.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('country.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
