<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nationality;

class NationalityController extends Controller
{
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

            toastr()->success(__('Data has been saved successfully!'));
            return redirect()->route('nationality.index');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('nationality.index');
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

            toastr()->success(__('Data has been Updated successfully!'));
            return redirect()->route('nationality.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('nationality.index');
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
            $Nationalitys = Nationality::findOrFail($id);
            $Nationalitys->delete();

            toastr()->success(__('Data has been Deleted successfully!'));
            return redirect()->route('nationality.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('nationality.index');
        }
    }
}
