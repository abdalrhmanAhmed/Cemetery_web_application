<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalController extends Controller
{
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

            toastr()->success(__('Data has been saved successfully!'));
            return redirect()->route('hospital.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('hospital.index');
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

            toastr()->success(__('Data has been Updated successfully!'));
            return redirect()->route('hospital.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('hospital.index');
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
            $hospitals = Hospital::findOrFail($id);
            $hospitals->delete();

            toastr()->success(__('Data has been Deleted successfully!'));
            return redirect()->route('hospital.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('hospital.index');
        }
    }
}
