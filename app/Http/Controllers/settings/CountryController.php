<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('settings.country.index', compact('countries'));
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
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);
            $countries = new Country();
            $countries->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $countries->save();

            return redirect()->route('country.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('country.index');
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
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);

            $countries = Country::findOrFail($id);
            $countries->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $countries->save();

            return redirect()->route('country.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('country.index');
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
            Country::destroy($id);
            return redirect()->route('country.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('country.index');
        }
    }
}
