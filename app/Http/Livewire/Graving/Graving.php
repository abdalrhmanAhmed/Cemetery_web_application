<?php

namespace App\Http\Livewire\Graving;

use App\Models\Block;
use App\Models\Cemetery;
use App\Models\Dead;
use App\Models\Gander;
use App\Models\Genealogy;
use App\Models\Grave;
use App\Models\Guardian;
use App\Models\Hospital;
use App\Models\Information;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Graving extends Component
{
    public $currentStep = 1;

    //step 1 variables
    public $ft_name_ar, $s_name_ar, $t_name_ar, $f_name_ar, $ft_name_en, $s_name_en, $t_name_en, $f_name_en,
            $identity, $age, $genealogy_id, $religin, $nationality, $gender;
    //step 2 variables
    public $guardian_name, $phone, $email, $address, $dead_date, $graving_date, $hospital, $dead_reasone;
    //step 3 variables
    public $cemetery_id, $blocks = [], $graves = [], $block_id, $grave_id;

    public function render()
    {
        return view('livewire.graving.graving', [
            'genealoges' => Genealogy::all(),
            'relagens' => Religion::all(),
            'nationalities' => Nationality::all(),
            'gendors' => Gander::all(),
            'hospitals' => Hospital::all(),
            'cemeteries' => Cemetery::all(),
        ]);
    }

    public function moveStep($step)
    {
        if($step == 2)
        {
            $this->validate([
                'ft_name_ar' => 'required',
                's_name_ar' => 'required',
                't_name_ar' => 'required',
                'f_name_ar' => 'required',
                'ft_name_en' => 'required',
                's_name_en' => 'required',
                't_name_en' => 'required',
                'f_name_en' => 'required',
                'identity' => 'required',
                'age' => 'required',
                'genealogy_id' => 'required',
                'religin' => 'required',
                'nationality' => 'required',
                'gender' => 'required',
            ]);
        }
        else if($step == 3)
        {
            $this->validate([
                'guardian_name' => 'required',
                'phone' => 'required',
                'dead_date' => 'required',
                'graving_date' => 'required',
                'hospital' => 'required',
                'dead_reasone' => 'required',
            ]);
        }
        $this->currentStep = $step;
    }

    public function getBlocks()
    {
        $this->blocks = Block::where('cemetery_id', $this->cemetery_id)->get();
    }

    public function getGraves()
    {
        $this->graves = Grave::where('block_id', $this->block_id)->get();
    }

    public function store()
    {
        DB::beginTransaction();
        try
        {
            $this->validate([
                'grave_id' => 'required'
            ]);

            $deceased = new Dead();
            $deceased->name = ['ar', $this->ft_name_ar, 'en' => $this->ft_name_en];
            $deceased->father = ['ar', $this->s_name_ar, 'en' => $this->s_name_en];
            $deceased->grand_father = ['ar', $this->t_name_ar, 'en' => $this->t_name_en];
            $deceased->great_grand_father = ['ar', $this->f_name_ar, 'en' => $this->f_name_en];
            $deceased->identity = $this->identity;
            $deceased->age = $this->age;
            $deceased->genealogy_id = $this->genealogy_id;
            $deceased->relagen_id = $this->religin;
            $deceased->national_id = $this->nationality;
            $deceased->gander_id = $this->gender;
            $deceased->save();

            $guardian = new Guardian();
            $guardian->name = $this->guardian_name;
            $guardian->phone_number = $this->phone;
            $guardian->email = $this->email;
            $guardian->address = $this->address;
            $guardian->save();

            $information = new Information();
            $information->deceased_id = $deceased->id;
            $information->guardian_id = $guardian->id;
            $information->hospital_id = $this->hospital;
            $information->grave_id = $this->grave_id;
            $information->medical_diagnosis = $this->dead_reasone;
            $information->date_of_death = $this->dead_date;
            $information->burial_date = now();
            $information->save();

            DB::commit();
            $this->clearForm();
            session()->flash('success','تم حفظ البيانات بنجاح');
            $this->currentStep = 1;
        }
        catch(\Illuminate\Validation\ValidationException  $e)
        {
            DB::rollBack();
            $validate = $e->validator;
            throw $e;
        }
    }


    public function clearForm()
    {
        $this->ft_name_ar = '';
        $this->s_name_ar = '';
        $this->t_name_ar = '';
        $this->f_name_ar = '';
        $this->ft_name_en = '';
        $this->s_name_en = '';
        $this->t_name_en = '';
        $this->f_name_en = '';
        $this->identity = '';
        $this->age = '';
        $this->genealogy_id = '';
        $this->religin = '';
        $this->nationality = '';
        $this->gender = '';
        $this->guardian_name = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->dead_date = '';
        $this->graving_date = '';
        $this->hospital = '';
        $this->dead_reasone = '';
        $this->cemetery_id = '';
        $this->block_id = '';
        $this->grave_id = '';
        $this->blocks = [];
        $this->graves = [];
    }
}
