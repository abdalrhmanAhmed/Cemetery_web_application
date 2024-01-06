<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Dead;
use Illuminate\Http\Request;
use App\Models\Religion;

class ReligionController extends Controller
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
        $religions = Religion::all();
        return view('settings.religions.index', compact('religions'));
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
                'name_en' => 'required'
            ]);
            $Religions = new Religion();
            $Religions->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Religions->save();

            return redirect()->route('religion.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e)
        {
            return redirect()->route('religion.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'name' => 'required'
            ]);

            $Religions = Religion::findOrFail($id);
            $Religions->name = $request->name;
            $Religions->save();

            return redirect()->route('religion.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('religion.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $dead = Dead::where('relagen_id', $id)->get();
            if($dead)
            {
                return redirect()->route('religion.index')->with(['error' => __('You Can`t Delete This Religion')]);
            }else{
                $Religions = Religion::findOrFail($id);
                $Religions->delete();
            }

            return redirect()->route('religion.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('religion.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
