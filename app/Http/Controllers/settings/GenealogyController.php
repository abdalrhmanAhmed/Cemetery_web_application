<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genealogy;

class GenealogyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genealogys = Genealogy::all();
        return view('settings.genealogys.index', compact('genealogys'));
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
            $Genealogys = new Genealogy();
            $Genealogys->name = $request->name;
            $Genealogys->save();

            return redirect()->route('gnealogy.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('gnealogy.index');
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
            $Genealogys = Genealogy::findOrFail($id);
            $Genealogys->name = $request->name;
            $Genealogys->save();

            return redirect()->route('gnealogy.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gnealogy.index');
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
            $Genealogys = Genealogy::findOrFail($id);
            $Genealogys->delete();

            return redirect()->route('gnealogy.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gnealogy.index');
        }
    }
}
