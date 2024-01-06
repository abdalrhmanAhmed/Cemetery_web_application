<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Dead;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Information;

class HospitalController extends Controller
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
        $hospitals = Hospital::all();
        return view('settings.hospitals.index', compact('hospitals'));
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

            $hospitals = new Hospital();
            $hospitals->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $hospitals->save();

            return redirect()->route('hospital.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e)
        {
            return redirect()->route('hospital.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);

            $hospitals = Hospital::findOrFail($id);
            $hospitals->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $hospitals->save();

            return redirect()->route('hospital.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('hospital.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $info = Information::where('hospital_id', $id)->get();
            if($info)
            {
                return redirect()->route('hospital.index')->with(['error' => __('You Can`t Delete This Hospital')]);
            }else{
                $hospitals = Hospital::findOrFail($id);
                $hospitals->delete();
            }

            return redirect()->route('hospital.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('hospital.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
