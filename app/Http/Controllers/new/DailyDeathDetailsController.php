<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyDeathsDetail;
use Auth;

class DailyDeathDetailsController extends Controller
{
    public function store(Request $request, $id)
    {
        try 
        {
            $this->validate($request, [
                'type' => 'required',
                'value' => 'required',
            ]);
            $Contact = new DailyDeathsDetail();
            $Contact->key = $request->type;
            $Contact->value = $request->value;
            $Contact->daily_death_id = $id;
            $Contact->created_by = Auth::id();
            $Contact->updated_by = 1;
            $Contact->save();

            return redirect()->route('DailyDeathController.index', $Contact->id)->with(['success' => __('Data has been saved successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('DailyDeathController.index')->with(['error' => __('There Is A Problem With The Server')]);
        } 
    }

    public function destroy($id)
    {
        try 
        {
            $CemeterySites = DailyDeathsDetail::findOrFail($id);
            $CemeterySites->forceDelete();

            return redirect()->route('DailyDeathController.index')->with(['success' => __('Data has been Deleted successfully!')]);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('DailyDeathController.index')->with(['error' => __('There Is A Problem With The Server')]);
        }   
    }
}
