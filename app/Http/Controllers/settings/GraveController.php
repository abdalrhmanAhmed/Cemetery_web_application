<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\GraveRequest;
use App\Models\Block;
use App\Models\BurialExcel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GraveController extends Controller
{    public function __construct()
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
        $graves = BurialExcel::select('id', 'Grave_Code')->get();
        return view('settings.graves.index', compact('graves'));
    }

    public function destroy($id)
    {
        $grave = BurialExcel::findOrFail($id);
        if($grave->status == 1)
        {
            return redirect()->route('graves.index')->with(['error' => __('The Grave Is Used')]);
        }else {$grave->delete();}
        
        return redirect()->route('graves.index')->with(['warning' => __('Data has been Deleted successfully!')]);
    }
}
