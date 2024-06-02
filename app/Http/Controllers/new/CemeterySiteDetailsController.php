<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CemeterySitesDetails;
use Auth;


class CemeterySiteDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'type' => 'required',
                'file' => 'required',
            ]);
            $libares = new CemeterySitesDetails();
            if ($request->has('file')) {
                $extension = $request->file('file')->extension();
                $image_name = upload('cemetery_sites_details/', $extension, $request->file('file'));
            } else {
                $image_name = 'def.png';
            }
            if($request->type == 1)
            {
                $libares->value = $image_name;//helper function to save image
            }
            elseif($request->type == 3)
            {
                $libares->value = $image_name;//helper function to save image
            }
            elseif($request->type == 2)
            {
                $libares->value = $image_name;//helper function to save image
            }
            else
            {
                $libares->text = $image_name;//helper function to save image
            }
            $libares->cemetery_sites_id = $id;
            $libares->created_by = Auth::id();
            $libares->type = $request->type;
            $libares->save();

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return $e;//redirect()->route('cemetery-site.show',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }

    public function text(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'value' => 'required',
            ]);
            $libares = new CemeterySitesDetails();
            $libares->type = 0;
            $libares->value = $request->text;
            $libares->cemetery_sites_id = $id;
            $libares->status = 1;
            $libares->created_by = Auth::id();
            $libares->save();

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return $e;redirect()->route('cemetery-site.index',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }

    public function delete($id)
    {        
        try 
        {
            $libares =  CemeterySitesDetails::findOrFail($id);
            $libares->forceDelete();

            return redirect()->back()->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('cemetery-site.index',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }
}
