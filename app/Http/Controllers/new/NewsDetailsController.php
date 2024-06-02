<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsDetails;
use Auth;

class NewsDetailsController extends Controller
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
            $libares = new NewsDetails();
            if ($request->has('file')) {
                $extension = $request->file('file')->extension();
                $image_name = upload('News-details/', $extension, $request->file('file'));
            } else {
                $image_name = 'def.png';
            }
            if($request->type == 1)
            {
                $libares->type = 1;//helper function to save image
                $libares->value = $image_name;//helper function to save image
            }
            elseif($request->type == 2)
            {
                $libares->type = 3;//helper function to save image
                $libares->value = $image_name;//helper function to save image
            }
            elseif($request->type == 3)
            {
                $libares->type = 2;//helper function to save image
                $libares->value = $image_name;//helper function to save image
            }
            $libares->news_id = $id;
            $libares->status = 1;
            $libares->created_by = Auth::id();
            $libares->updated_by = 0;
            $libares->save();

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('NewsController.show',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }

    public function text(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'text' => 'required',
            ]);
            $libares = new NewsDetails();
            $libares->type = 0;
            $libares->value = $request->text;
            $libares->news_id = $id;
            $libares->status = 1;
            $libares->created_by = Auth::id();
            $libares->updated_by = 0;
            $libares->save();

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return $e;//redirect()->route('NewsController.show',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }

    public function delete($id)
    {        
        try 
        {
            $libares =  NewsDetails::findOrFail($id);
            $libares->forceDelete();

            return redirect()->back()->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('NewsController.show',$id)->with(['error' => __('There Is A Problem With The Server')]);
        }    
    }
}
