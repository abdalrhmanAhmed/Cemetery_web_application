<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gander;

class GanderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ganders = Gander::all();
        return view('settings.ganders.index', compact('ganders'));
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
            $ganders = new Gander();
            $ganders->name = $request->name;
            $ganders->save();

            return redirect()->route('gander.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('gander.index');
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
            $ganders = Gander::findOrFail($id);
            $ganders->name = $request->name;
            $ganders->save();

            return redirect()->route('gander.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gander.index');
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
            $ganders = Gander::findOrFail($id);
            $ganders->delete();

            return redirect()->route('gander.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gander.index');
        }
    }
}
