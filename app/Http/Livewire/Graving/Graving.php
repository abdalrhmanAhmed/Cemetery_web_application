<?php

namespace App\Http\Livewire\Graving;

use App\Models\Gander;
use App\Models\Genealogy;
use App\Models\Nationality;
use App\Models\Religion;
use Livewire\Component;

class Graving extends Component
{
    public $currentStep = 1;

    public function render()
    {
        return view('livewire.graving.graving', [
            'genealoges' => Genealogy::all(),
            'relagens' => Religion::all(),
            'nationalities' => Nationality::all(),
            'gendors' => Gander::all(),
        ]);
    }

    public function moveStep($step)
    {
        $this->currentStep = $step;
    }
}
