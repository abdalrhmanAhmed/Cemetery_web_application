<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::all();
        return view('posts.quote.index', compact('quotes'));
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
            $quotes = new Quote();
            $quotes->title = $request->title;
            $quotes->sub_title = $request->sub_title;
            $quotes->text = $request->text;
            $quotes->save();
            toastr()->success('تمت اللإضافة بنجاح');
            return redirect()->route('quote.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('quote.index');
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
            $quotes =  Quote::findOrFail($id);
            $quotes->title = $request->title;
            $quotes->sub_title = $request->sub_title;
            $quotes->text = $request->text;
            $quotes->save();
            toastr()->warning('تم التعديل بنجاح');
            return redirect()->route('quote.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('quote.index');
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
            $quotes =  Quote::findOrFail($id);
            $quotes->delete();
            toastr()->success('تم حذف بنجاح');
            return redirect()->route('quote.index');
        } catch (\Exception $e) {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('quote.index');
        }
    }
}
