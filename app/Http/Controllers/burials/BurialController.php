<?php

namespace App\Http\Controllers\burials;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Cemetery;
use App\Models\City;
use App\Models\Country;
use App\Models\Dead;
use App\Models\Grave;
use App\Models\Information;
use Illuminate\Http\Request;

class BurialController extends Controller
{
    public function index()
    {
        $burials = Information::all();
        $countries = Country::all();
        return view('livewire.graving.table.table', compact('burials', 'countries'));
    }

    public function getCityes($id)
    {
        $cityes = City::where('country_id', $id)->pluck('name', 'id');
        return $cityes;
    }

    public function getCemetery($id)
    {
        $cemeteries = Cemetery::where('citiy_id', $id)->pluck('name', 'id');
        return $cemeteries;
    }

    public function getBlocks($id)
    {
        $blocks = Block::where('cemetery_id', $id)->pluck('name', 'id');
        return $blocks;
    }

    public function filter(Request $request)
    {
        $countries = Country::all();
        if(!$request->city)
        {
            $cityes = City::where('country_id', $request->country)->get('id');
            $cemeteries = Cemetery::whereIn('citiy_id', $cityes)->get('id');
            $blocks = Block::whereIn('cemetery_id', $cemeteries)->get('id');
            $graves = Grave::whereIn('block_id', $blocks)->get('id');
            $burials = Information::whereIn('grave_id', $graves)->get();
        }
        else if(!$request->cemetery)
        {
            $cemeteries = Cemetery::where('citiy_id', $request->city)->get('id');
            $blocks = Block::whereIn('cemetery_id', $cemeteries)->get('id');
            $graves = Grave::whereIn('block_id', $blocks)->get('id');
            $burials = Information::whereIn('grave_id', $graves)->get();
        }
        else if(!$request->block)
        {
            $blocks = Block::where('cemetery_id', $request->cemetery)->get('id');
            $graves = Grave::whereIn('block_id', $blocks)->get('id');
            $burials = Information::whereIn('grave_id', $graves)->get();
        }
        else
        {
            $graves = Grave::where('block_id', $request->block)->get('id');
            $burials = Information::whereIn('grave_id', $graves)->get();
        }
        return view('livewire.graving.table.table', compact('burials', 'countries'));
    }

    public function edit($id)
    {
        $burial = Information::findOrFail($id);
        return view('livewire.graving.editIndex', compact('burial'));
    }
}
