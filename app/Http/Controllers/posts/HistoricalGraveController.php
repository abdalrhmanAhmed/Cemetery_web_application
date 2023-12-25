<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoricalGrave;

class HistoricalGraveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historical_graves = HistoricalGrave::all();
        return view('posts.historical_grave.index', compact('historical_graves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $historical_grave = new HistoricalGrave();
            $historical_grave->title = $request->title;
            $historical_grave->sub_title = $request->sub_title;
            $historical_grave->text = $request->text;
            $historical_grave->location = $request->location;

            $historical_grave->save();

            return redirect()->route('historical_grave.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('historical_grave.index');
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
        //
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
            $historical_grave = HistoricalGrave::findOrfail($id);
            $historical_grave->title = $request->title;
            $historical_grave->sub_title = $request->sub_title;
            $historical_grave->text = $request->text;
            $historical_grave->location = $request->location;

            $historical_grave->save();

            return redirect()->route('historical_grave.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('historical_grave.index');
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
        $historical_grave =  HistoricalGrave::findOrfail($id);   
        $historical_grave->delete();
        return redirect()->route('historical_grave.index');
    }
}
