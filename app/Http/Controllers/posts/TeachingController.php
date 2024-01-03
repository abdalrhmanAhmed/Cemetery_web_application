<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teaching;

class TeachingController extends Controller
{
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
            $teachings = new Teaching();
            $teachings->title = $request->title;
            $teachings->sub_title = $request->sub_title;
            $teachings->text = $request->text;
            $teachings->save();
            toastr()->success('تمت اللإضافة بنجاح');
            return redirect()->route('teaching.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('teaching.index');
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
            $teachings =  Teaching::findOrFail($id);
            $teachings->title = $request->title;
            $teachings->sub_title = $request->sub_title;
            $teachings->text = $request->text;
            $teachings->save();
            toastr()->warning('تم التعديل بنجاح');
            return redirect()->route('teaching.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('teaching.index');
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
            toastr()->success('تم حذف بنجاح');
            return redirect()->route('teaching.index');
        } catch (\Exception $e) {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('teaching.index');
        }
    }
}
