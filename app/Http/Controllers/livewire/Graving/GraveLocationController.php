<?php

namespace App\Http\Controllers\livewire\Graving;

use App\Http\Controllers\Controller;
use App\Models\Grave;
use Illuminate\Http\Request;

class GraveLocationController extends Controller
{
    public function chooseLocation($id)
    {
        $grave = Grave::findOrFail($id);
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

        return view('livewire.graving.chooseLocation', compact('grave', 'initialMarkers'));
    }

    public function storeLocation(Request $request, $id)
    {
        return $id;
    }
}
