<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Dead;
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
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);
            $ganders = new Gander();
            $ganders->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $ganders->save();

            return redirect()->route('gander.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e)
        {
            return redirect()->route('gander.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $ganders = Gander::findOrFail($id);
            $ganders->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $ganders->save();

            return redirect()->route('gander.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gander.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $dead = Dead::where('gander_id', $id)->get();
            if($dead)
            {
                return redirect()->route('gander.index')->with(['error' => __('You Can`t Delete This Gender')]);
            }else{
                $ganders = Gander::findOrFail($id);
                $ganders->delete();
            }

            return redirect()->route('gander.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gander.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
