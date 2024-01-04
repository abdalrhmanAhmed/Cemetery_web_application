<?php

namespace App\Http\Controllers\livewire\Graving;

use App\Http\Controllers\Controller;
use App\Models\Grave;
use App\Models\Information;
use Illuminate\Http\Request;

class GraveLocationController extends Controller
{
    public function chooseLocation($grave_id, $information_id, $edit)
    {
        $grave = Grave::findOrFail($grave_id);
        $information = Information::findOrFail($information_id);
        $initialMarkers = [
            [
                'position' => [
                    'lat' => floatval($grave->blocks->latitude),
                    'lng' => floatval($grave->blocks->Longitude)
                ],
                'label' => [ 'color' => 'white'],
                'draggable' => true
            ],
        ];
        $latitude = floatval($grave->blocks->latitude);
        $longitude = floatval($grave->blocks->Longitude);
       
        return view('livewire.graving.chooseLocation', compact('grave', 'initialMarkers', 'information', 'edit', 'latitude', 'longitude'));
    }

    public function storeLocation(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
            $grave = Grave::findOrFail($id);
            $grave->latitude = $request->latitude;
            $grave->Longitude = $request->longitude;
            $grave->save();

            return redirect()->to('/graving')->with(['warning' => $request->editMode == 1 ? __('Data has been Updated successfully!') : __('Data has been saved successfully!')]);
        }
        catch(\Exception $e)
        {
            return redirect()->to('/graving')->with(['error' => __('There Is A Problem With The Server')]);
        }

    }
}
