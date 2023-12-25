<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedure;

class ProcedureController extends Controller
{
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
            $procedures = new Procedure();
            $procedures->title = $request->title;
            $procedures->sub_title = $request->sub_title;
            $procedures->text = $request->text;
            $procedures->save();
            return redirect()->route('procedure.index');
        } 
        catch (\Exception $e) 
        {
            
            return redirect()->route('procedure.index');
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
            $procedures =  Procedure::findOrFail($id);
            $procedures->title = $request->title;
            $procedures->sub_title = $request->sub_title;
            $procedures->text = $request->text;
            $procedures->save();
            return redirect()->route('procedure.index');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('procedure.index');
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
            return redirect()->route('procedure.index');
        } catch (\Exception $e) {
            return redirect()->route('procedure.index');
        }
    }
}
