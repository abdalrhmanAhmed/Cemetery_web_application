<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::get();
        return view('new.Notification.index', compact('notifications'));
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
                'description' => 'required',
                'file' => 'required',
            ]);
            $notification = new Notification();
            if ($request->has('file')) {
                $image_name = upload('notification-profile/', 'png', $request->file('file'));
            } else {
                $image_name = 'def.png';
            }
            $notification->title = ['ar' => $request->ar, 'en' => $request->en];
            $notification->image = $image_name;
            $notification->description = $request->description;
            $notification->status = 1;
            $notification->save();
    
            return redirect()->route('Notification.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('Notification.index')->with(['error' => __('There Is A Problem With The Server')]);
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
        $notification = Notification::findOrFail($id);
        return view('new.Notification.edit', compact('notification'));
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
                // 'description' => 'required',
                'file' => 'required',
            ]);
            $notification = Notification::findOrFail($id);
            if ($request->has('file')) {
                $image_name = upload('notification-profile/', 'png', $request->file('file'));
            } else {
                $image_name = 'def.png';
            }
            $notification->title = ['ar' => $request->ar, 'en' => $request->en];
            $notification->image = $image_name;
            $notification->description = $request->description ?? $notification->description;
            $notification->status = 1;
            $notification->save();
    
            return redirect()->route('Notification.index')->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return $e;redirect()->route('Notification.index')->with(['error' => __('There Is A Problem With The Server')]);
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
            $libares = Notification::findOrFail($request->id);
            $libares->forceDelete();
    
            return redirect()->route('Notification.index', $libares->id)->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('Notification.index')->with(['error' => __('There Is A Problem With The Server')]);
        }
    }
}
