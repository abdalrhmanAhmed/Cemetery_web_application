<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\GraveRequest;
use App\Models\Block;
use App\Models\Grave;
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
        $blocks = Block::all();
        $graves = Grave::with('blocks')->get();
        return view('settings.graves.index', compact('blocks', 'graves'));
    }

    public function destroy($id)
    {
        $grave = Grave::findOrFail($id);
        if($grave->status == 1)
        {
            return redirect()->route('graves.index')->with(['error' => __('The Grave Is Used')]);
        }else {$grave->delete();}
        
        return redirect()->route('graves.index')->with(['warning' => __('Data has been Deleted successfully!')]);
    }
}
