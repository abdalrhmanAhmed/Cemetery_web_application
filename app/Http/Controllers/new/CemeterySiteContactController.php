<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CemeterySitesContact;

class CemeterySiteContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'type' => 'required',
                'value' => 'required',
            ]);
            $Contact = new CemeterySitesContact();
            $Contact->type = $request->type;
            $Contact->value = $request->value;
            $Contact->cemetery_sites_id = $id;
            $Contact->save();

            return redirect()->route('cemetery-site.index', $Contact->id)->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return $e;//redirect()->route('cemetery-site.index')->with(['error' => __('There Is A Problem With The Server')]);
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
        //
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
            $CemeterySites = CemeterySitesContact::findOrFail($id);
            $CemeterySites->forceDelete();

            return redirect()->route('cemetery-site.index')->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return $e;redirect()->route('cemetery-site.index')->with(['error' => __('There Is A Problem With The Server')]);
        }   
    }
}
