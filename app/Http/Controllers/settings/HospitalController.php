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
            $hospitals = new Hospital();
            $hospitals->name = $request->name;
            $hospitals->save();

            return redirect()->route('hospital.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('hospital.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 1;
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
            $hospitals = Hospital::findOrFail($id);
            $hospitals->name = $request->name;
            $hospitals->save();

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

            return redirect()->route('hospital.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('hospital.index');
        }
    }
}
