<?php

namespace App\Http\Controllers\new;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CemeterySites;

class CemeterySiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactMethod = contactMethod();
        $cemetery_sites = CemeterySites::get();
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
        return view('new.cemetery_sites.index',compact('cemetery_sites', 'initialMarkers', 'contactMethod'));
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
            $this->validate($request, [
                'ar' => 'required',
                'en' => 'required',
                'image' => 'required',
                'text' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
            $cemetery_sites = new CemeterySites();
            $cemetery_sites->name = ['ar' => $request->ar, 'en' => $request->en];
            if ($request->has('image')) {
                $image_name = upload('cemetery_sites-profile/', 'png', $request->file('image'));
            } else {
                $image_name = 'def.png';
            }
            $cemetery_sites->image = $image_name;//helper function to save image
            $cemetery_sites->text = $request->text;
            $cemetery_sites->dead_total = 0;//helper function to save image
            $cemetery_sites->latitude = $request->latitude;
            $cemetery_sites->longitude = $request->longitude;
            $cemetery_sites->save();

            return redirect()->route('cemetery-site.index', $cemetery_sites->id)->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return $e;redirect()->route('cemetery-site.index')->with(['error' => __('There Is A Problem With The Server')]);
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
        $cemetery_sites = CemeterySites::where('id', $id)->first();
        return view('new.cemetery_sites.show', compact('cemetery_sites'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cemetery_sites = CemeterySites::where('id', $id)->first();
        $initialMarkers = [
            [
                'position' => [
                    'lat' => intval($cemetery_sites->latitude),
                    'lng' => intval($cemetery_sites->longitude)
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        return view('new.cemetery_sites.edit', compact('cemetery_sites', 'initialMarkers'));
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
            $cemetery_sites = CemeterySites::findOrFail($id);
            $cemetery_sites->name = ['ar' => $request->ar, 'en' => $request->en];
            if ($request->has('image')) {
                $image_name = upload('cemetery_sites-profile/', 'png', $request->file('image'));
            } else {
                $image_name = $cemetery_sites->image;
            }
            $cemetery_sites->image = $image_name;//helper function to save image
            $cemetery_sites->text = $request->text;
            $cemetery_sites->dead_total = 0;//helper function to save image
            $cemetery_sites->latitude = $request->latitude;
            $cemetery_sites->longitude = $request->longitude;
            $cemetery_sites->save();
            
            return redirect()->route('cemetery-site.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery-site.index')->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try 
        {
            $this->validate($request, [
                'id' => 'required',
            ]);
            $CemeterySites = CemeterySites::findOrFail($request->id);
            $CemeterySites->forceDelete();

            return redirect()->route('cemetery-site.index')->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery-site.index')->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }
}
