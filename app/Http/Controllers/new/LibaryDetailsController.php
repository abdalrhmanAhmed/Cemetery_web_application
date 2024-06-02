<?php

namespace App\Http\Controllers\new;
use App\Http\Controllers\Controller;
use App\Models\LibraryDetail;
use Auth;



use Illuminate\Http\Request;

class LibaryDetailsController extends Controller
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
            $libares = new LibraryDetail();
            if ($request->has('file')) {
                $extension = $request->file('file')->extension();
                $image_name = upload('libary-details/', $extension, $request->file('file'));
            } else {
                $image_name = 'def.png';
            }
            if($request->type == 1)
            {
                $libares->video = $image_name;//helper function to save image
            }
            elseif($request->type == 2)
            {
                $libares->voice = $image_name;//helper function to save image
            }
            elseif($request->type == 3)
            {
                $libares->image = $image_name;//helper function to save image
            }
            else
            {
                $libares->text = $image_name;//helper function to save image
            }
            $libares->library_id = $id;
            $libares->created_by = Auth::id();
            $libares->save();

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('show.libary',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }

    public function text(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'text' => 'required',
            ]);
            $libares = new LibraryDetail();
            $libares->text = $request->text;
            $libares->library_id = $id;
            $libares->created_by = Auth::id();
            $libares->save();

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('show.libary',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }

    public function delete($id)
    {        
        try 
        {
            $libares =  LibraryDetail::findOrFail($id);
            $libares->forceDelete();

            return redirect()->back()->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('show.libary',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }
}
