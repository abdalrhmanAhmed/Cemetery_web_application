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
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);
            $ganders = new Gander();
            $ganders->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $ganders->save();

            toastr()->success(__('Data has been saved successfully!'));
            return redirect()->route('gander.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('gander.index');
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

            toastr()->success(__('Data has been Updated successfully!'));
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
            toastr()->success(__('Data has been Deleted successfully!'));
            return redirect()->route('gander.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gander.index');
        }
    }
}
