<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nationality;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalitys = Nationality::all();
        return view('settings.nationalitys.index', compact('nationalitys'));
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
            $Nationalitys = new Nationality();
            $Nationalitys->name = $request->name;
            $Nationalitys->save();

            return redirect()->route('nationality.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('nationality.index');
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
            $Nationalitys = Nationality::findOrFail($id);
            $Nationalitys->name = $request->name;
            $Nationalitys->save();

            return redirect()->route('nationality.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('nationality.index');
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
            $Nationalitys = Nationality::findOrFail($id);
            $Nationalitys->delete();

            return redirect()->route('nationality.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('nationality.index');
        }
    }
}
