<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedure;

class ProcedureController extends Controller
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
        $procedures = Procedure::all();
        return view('posts.procedure.index', compact('procedures'));
    }


    public function store(Request $request)
    {
        try 
        {
            $procedures = new Procedure();
            $procedures->title = $request->title;
            $procedures->sub_title = $request->sub_title;
            $procedures->text = $request->text;
            $procedures->save();

            return redirect()->route('procedure.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('procedure.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }


    public function update(Request $request, $id)
    {
        try 
        {
            $procedures =  Procedure::findOrFail($id);
            $procedures->title = $request->title;
            $procedures->sub_title = $request->sub_title;
            $procedures->text = $request->text;
            $procedures->save();

            return redirect()->route('procedure.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('procedure.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $procedures =  Procedure::findOrFail($id);
            $procedures->delete();
            return redirect()->route('procedure.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } catch (\Exception $e) {
            return redirect()->route('procedure.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
