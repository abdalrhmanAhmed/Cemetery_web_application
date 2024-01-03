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

            toastr()->success('تمت اللإضافة بنجاح');
            return redirect()->route('historical_grave.index');
        } 
        catch (\Exception $e) 
        {
            return $e;
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('historical_grave.create');
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
                    'lat' => $historical_grave->latitude,
                    'lng' => $historical_grave->Longitude
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
            $historical_grave->sub_title = $request->sub_title;
            $historical_grave->text = $request->text;
            $historical_grave->location = $request->location;
            $historical_grave->save();
            toastr()->warning('تم التعديل بنجاح');
            return redirect()->route('historical_grave.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
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
        try 
        {
            $historical_grave =  HistoricalGrave::findOrfail($id);   
            $historical_grave->delete();
            toastr()->success('تم حذف بنجاح');
            return redirect()->route('historical_grave.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('historical_grave.index');
        }


    }
}
