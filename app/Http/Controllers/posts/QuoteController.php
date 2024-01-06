<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
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
        $quotes = Quote::all();
        return view('posts.quote.index', compact('quotes'));
    }

 
    public function store(Request $request)
    {
        try 
        {
            $this->validate($request, [
                'title' => 'required',
                'sub_title' => 'required',
                'text' => 'required'
            ]);

            $quotes = new Quote();
            $quotes->title = $request->title;
            $quotes->sub_title = $request->sub_title;
            $quotes->text = $request->text;
            $quotes->save();

            return redirect()->route('quote.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('quote.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }



    public function update(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'title' => 'required',
                'sub_title' => 'required',
                'text' => 'required'
            ]);

            $quotes =  Quote::findOrFail($id);
            $quotes->title = $request->title;
            $quotes->sub_title = $request->sub_title;
            $quotes->text = $request->text;
            $quotes->save();

            return redirect()->route('quote.index')->with(['success' => __('Data has been Updated successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('quote.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            return redirect()->route('quote.index')->with(['warning' => __('Data has been Deleted successfully!')]);
        } catch (\Exception $e) {
            return redirect()->route('quote.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
