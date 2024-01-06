<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
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
        $contacts = Contact::all();
        return view('posts.contact.index', compact('contacts'));
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
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->url = $request->url;
            $contact->icon = $request->icon;
            // $contact->Longitude = $request->longitude;
            $contact->save();
            
            toastr()->success('تمت اللإضافة بنجاح');
            return redirect()->route('contact.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('contact.index');
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
        //
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
            $contact =  Contact::findOrFail($id);
            $contact->name = $request->name;
            $contact->url = $request->url;
            $contact->icon = $request->icon;
            $contact->save();
            toastr()->warning('تم التعديل بنجاح');
            return redirect()->route('contact.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('contact.index');
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
            $contact =  Contact::findOrFail($id);
            $contact->delete();
            toastr()->success('تم حذف بنجاح');
            return redirect()->route('contact.index');
        } 
        catch (\Exception $e) 
        {
            toastr()->error('يوجد خطأ في البيانات المدخلة');
            return redirect()->route('contact.index');
        }

    }
}
