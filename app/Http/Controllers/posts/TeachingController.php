<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teaching;

class TeachingController extends Controller
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
        $teachings = Teaching::all();
        return view('posts.teaching.index', compact('teachings'));
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
                'title' => 'requried',
                'sub_title' => 'required',
                'text' => 'required'
            ]);

            $teachings = new Teaching();
            $teachings->title = $request->title;
            $teachings->sub_title = $request->sub_title;
            $teachings->text = $request->text;
            $teachings->save();
            
            return redirect()->route('teaching.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('teaching.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }


 
    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'title' => 'requried',
                'sub_title' => 'required',
                'text' => 'required'
            ]);

            $teachings =  Teaching::findOrFail($id);
            $teachings->title = $request->title;
            $teachings->sub_title = $request->sub_title;
            $teachings->text = $request->text;
            $teachings->save();

            return redirect()->route('teaching.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('teaching.index')->with(['error' => __('There Is A Problem With The Server')]);
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
        try {
            $teachings =  Teaching::findOrFail($id);
            $teachings->delete();
            return redirect()->route('teaching.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } catch (\Exception $e) {
            return redirect()->route('teaching.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
