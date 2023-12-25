<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Religion;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $religions = Religion::all();
        return view('settings.religions.index', compact('religions'));
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
            $Religions = new Religion();
            $Religions->name = $request->name;
            $Religions->save();

            return redirect()->route('religion.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('religion.index');
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
            $Religions = Religion::findOrFail($id);
            $Religions->name = $request->name;
            $Religions->save();

            return redirect()->route('religion.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('religion.index');
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
            $Religions = Religion::findOrFail($id);
            $Religions->delete();

            return redirect()->route('religion.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('religion.index');
        }
    }
}
