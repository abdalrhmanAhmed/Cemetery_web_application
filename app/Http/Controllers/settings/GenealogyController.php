<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Dead;
use Illuminate\Http\Request;
use App\Models\Genealogy;

class GenealogyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genealogys = Genealogy::all();
        return view('settings.genealogys.index', compact('genealogys'));
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

            $Genealogys = new Genealogy();
            $Genealogys->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Genealogys->save();

            return redirect()->route('gnealogy.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e)
        {
            return redirect()->route('gnealogy.index')->with(['error' => __('There Is A Problem With The Server')]);
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

            $Genealogys = Genealogy::findOrFail($id);
            $Genealogys->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Genealogys->save();

            return redirect()->route('gnealogy.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gnealogy.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $dead = Dead::where('genealogy_id', $id)->get();
            if($dead)
            {
                return redirect()->route('gnealogy.index')->with(['error' => __('You Can`t Delete This Genealogy')]);
            }else{
                $Genealogys = Genealogy::findOrFail($id);
                $Genealogys->delete();
            }

            return redirect()->route('gnealogy.index')->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('gnealogy.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
