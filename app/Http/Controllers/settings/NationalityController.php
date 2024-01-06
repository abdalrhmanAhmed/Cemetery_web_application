<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Dead;
use Illuminate\Http\Request;
use App\Models\Nationality;

class NationalityController extends Controller
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
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);

            $Nationalitys = new Nationality();
            $Nationalitys->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Nationalitys->save();

            return redirect()->route('nationality.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e)
        {
            return redirect()->route('nationality.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }


    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);

            $Nationalitys = Nationality::findOrFail($id);
            $Nationalitys->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Nationalitys->save();

            return redirect()->route('nationality.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('nationality.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $dead = Dead::where('national_id', $id)->get();
            if($dead)
            {
                return redirect()->route('nationality.index')->with(['error' => __('You Can`t Delete This Nationality')]);
            }else{
                $Nationalitys = Nationality::findOrFail($id);
                $Nationalitys->delete();
            }

            
            return redirect()->route('nationality.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('nationality.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
