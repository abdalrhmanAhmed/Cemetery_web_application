<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoricalGrave;

class HistoricalGraveController extends Controller
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
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 25.1338688,
                    'lng' => 56.3332739
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        return view('posts.historical_grave.add', compact('initialMarkers'));
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
            $historical_grave->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $historical_grave->text = $request->text;
            $historical_grave->latitude = $request->latitude;
            $historical_grave->Longitude = $request->longitude;
            $historical_grave->save();

            return redirect()->route('historical_grave.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('historical_grave.create')->with(['error' => __('There Is A Problem With The Server')]);
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
        $historical_grave = HistoricalGrave::where('id', $id)->first();
        $initialMarkers = [
            [
                'position' => [
                    'lat' => floatval($historical_grave->latitude),
                    'lng' => floatval($historical_grave->Longitude)
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        return view('posts.historical_grave.edit', compact('historical_grave', 'initialMarkers'));
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
            $historical_grave->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $historical_grave->text = $request->text;
            $historical_grave->latitude = $request->latitude;
            $historical_grave->Longitude = $request->longitude;
            $historical_grave->save();
            return redirect()->route('historical_grave.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('historical_grave.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $historical_grave =  HistoricalGrave::findOrfail($id);   
            $historical_grave->delete();
            return redirect()->route('historical_grave.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('historical_grave.index')->with(['error' => __('There Is A Problem With The Server')]);
        }


    }
}
