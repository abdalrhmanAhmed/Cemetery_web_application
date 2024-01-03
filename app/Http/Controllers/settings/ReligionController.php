<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Religion;

class ReligionController extends Controller
{
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

            toastr(__('Data has been saved successfully!'), 'success');
            return redirect()->route('religion.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('religion.index');
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

            toastr(__('Data has been Updated successfully!'), 'success');
            return redirect()->route('religion.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('religion.index');
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
            $Religions = Religion::findOrFail($id);
            $Religions->delete();

            toastr(__('Data has been Deleted successfully!'), 'success');
            return redirect()->route('religion.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('religion.index');
        }
    }
}
