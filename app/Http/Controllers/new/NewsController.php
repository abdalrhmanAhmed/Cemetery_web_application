<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
// use App/Helpers/Helpers;
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
    $libares = News::get();
    return view('new.News.index', compact('libares'));
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
            'ar' => 'required',
            'en' => 'required',
            'image' => 'required',
        ]);
        $libares = new News();
        $libares->name = ['ar' => $request->ar, 'en' => $request->en];
        if ($request->has('image')) {
            $image_name = upload('News-profile/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        }
        $libares->image = $image_name;//helper function to save image
        $libares->save();

        return redirect()->route('NewsController.show', $libares->id)->with(['success' => __('Data has been saved successfully!')]);
    } 
    catch (\Exception $e) 
    {
        return redirect()->route('NewsController.index')->with(['error' => __('There Is A Problem With The Server')]);
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
    $libary = News::where('id', $id)->first();
    return view('new.News.show', compact('libary'));
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $libary = News::findOrFail($id);
    return view('new.News.edit', compact('libary'));
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
        $this->validate($request, [
            'ar' => 'required',
            'en' => 'required',
        ]);
        $libares =  News::findOrFail($id);
        $libares->name = ['ar' => $request->ar, 'en' => $request->en];
        if ($request->has('image')) {
            $image_name = upload('News-profile/', 'png', $request->file('image'));
        } else {
            $image_name = $libares->image;
        }
        $libares->image = $image_name;
        $libares->save();

        return redirect()->route('NewsController.index', $libares->id)->with(['success' => __('Data has been saved successfully!')]);
    } 
    catch (\Exception $e) 
    {
        return redirect()->route('NewsController.index')->with(['error' => __('There Is A Problem With The Server')]);
    }
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy(Request $request)
{
    try 
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $libares = News::findOrFail($request->id);
        $libares->forceDelete();

        return redirect()->route('NewsController.index', $libares->id)->with(['success' => __('Data has been Deleted successfully!')]);
    } 
    catch (\Exception $e) 
    {
        return $e;redirect()->route('NewsController.index')->with(['error' => __('There Is A Problem With The Server')]);
    }
}
}
