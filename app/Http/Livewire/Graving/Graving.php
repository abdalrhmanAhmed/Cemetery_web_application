<?php

namespace App\Http\Livewire\Graving;

use App\Models\Block;
use App\Models\Cemetery;
use App\Models\City;
use App\Models\Country;
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
use Livewire\WithPagination;

class Graving extends Component
{
    use WithPagination;

    public $currentStep = 1;
    // public $paginate = 3;
    public $search = '';

    //config tabel and edit mode
    public $showTable = true;
    public $editMode = false, $information_id , $deceased_id, $guardian_id, $old_grave_id;
    public $filterMode = false;

    //filter data
    public $filter_country_id = '',
           $filter_city_id = '',
           $filter_block_id = '',
           $filter_cemetery_id = '';
    public $filter_cityes = [],
           $filter_blocks = [],
           $filter_cemeteries = [];

    //step 1 variables
    public $ft_name_ar, $s_name_ar, $t_name_ar, $f_name_ar, $ft_name_en, $s_name_en, $t_name_en, $f_name_en,
            $identity, $age, $genealogy_id, $religin, $nationality, $gender;
    //step 2 variables
    public $guardian_name, $phone, $email, $address, $dead_date, $graving_date, $hospital, $dead_reasone;
    //step 3 variables
    public $cemetery_id, $blocks = [], $graves = [], $block_id, $grave_id;

    public function render()
    {
        if($this->filterMode)
        {
            if($this->filter_country_id == '')
            {
                $burials = Information::with(['graves', 'deceased'])->where(fn($query) => 
                                            $query->whereHas('graves', fn($query2) => 
                                                $query2->where('name', 'LIKE','%'.$this->search.'%')
                                            )->orWhereHas('deceased', fn($query3) => 
                                                $query3->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                       ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                            )->orWhereHas('graves', fn($query4) => 
                                                $query4->with('blocks')->whereHas('blocks', fn($q) => 
                                                    $q->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                    ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                )
                                            )->orWhereHas('graves', fn($query5) =>
                                                $query5->with('blocks')->whereHas('blocks', fn($qu) => 
                                                    $qu->with('cemeteries')->whereHas('cemeteries', fn($que) => 
                                                        $que->where('name', 'LIKE', '%'.$this->search.'%')
                                                            ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                    )
                                                )
                                            )
                                        )->paginate(3);
            }
            else if($this->filter_city_id == '')
            {
                $cityes = City::where('country_id', $this->filter_country_id)->get('id');
                $cemeteries = Cemetery::whereIn('citiy_id', $cityes)->get('id');
                $blocks = Block::whereIn('cemetery_id', $cemeteries)->get('id');
                $graves = Grave::whereIn('block_id', $blocks)->get('id');
                $burials = Information::whereIn('grave_id', $graves)->with(['graves', 'deceased'])->where(fn($query) => 
                                            $query->whereHas('graves', fn($query2) => 
                                                $query2->where('name', 'LIKE','%'.$this->search.'%')
                                            )->orWhereHas('deceased', fn($query3) => 
                                                $query3->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                       ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                            )->orWhereHas('graves', fn($query4) => 
                                                $query4->with('blocks')->whereHas('blocks', fn($q) => 
                                                    $q->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                    ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                )
                                            )->orWhereHas('graves', fn($query5) =>
                                                $query5->with('blocks')->whereHas('blocks', fn($qu) => 
                                                    $qu->with('cemeteries')->whereHas('cemeteries', fn($que) => 
                                                        $que->where('name', 'LIKE', '%'.$this->search.'%')
                                                            ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                    )
                                                )
                                            )
                                        )->paginate(3);
            }
            else if($this->filter_cemetery_id == '')
            {
                $cemeteries = Cemetery::where('citiy_id', $this->filter_city_id)->get('id');
                $blocks = Block::whereIn('cemetery_id', $cemeteries)->get('id');
                $graves = Grave::whereIn('block_id', $blocks)->get('id');
                $burials = Information::whereIn('grave_id', $graves)->with(['graves', 'deceased'])->where(fn($query) => 
                                            $query->whereHas('graves', fn($query2) => 
                                                $query2->where('name', 'LIKE','%'.$this->search.'%')
                                            )->orWhereHas('deceased', fn($query3) => 
                                                $query3->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                       ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                            )->orWhereHas('graves', fn($query4) => 
                                                $query4->with('blocks')->whereHas('blocks', fn($q) => 
                                                    $q->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                    ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                )
                                            )->orWhereHas('graves', fn($query5) =>
                                                $query5->with('blocks')->whereHas('blocks', fn($qu) => 
                                                    $qu->with('cemeteries')->whereHas('cemeteries', fn($que) => 
                                                        $que->where('name', 'LIKE', '%'.$this->search.'%')
                                                            ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                    )
                                                )
                                            )
                                        )->paginate(3);
            }
            else if($this->filter_block_id == '')
            {
                $blocks = Block::where('cemetery_id', $this->filter_cemetery_id)->get('id');
                $graves = Grave::whereIn('block_id', $blocks)->get('id');
                $burials = Information::whereIn('grave_id', $graves)->with(['graves', 'deceased'])->where(fn($query) => 
                                            $query->whereHas('graves', fn($query2) => 
                                                $query2->where('name', 'LIKE','%'.$this->search.'%')
                                            )->orWhereHas('deceased', fn($query3) => 
                                                $query3->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                       ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                            )->orWhereHas('graves', fn($query4) => 
                                                $query4->with('blocks')->whereHas('blocks', fn($q) => 
                                                    $q->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                    ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                )
                                            )->orWhereHas('graves', fn($query5) =>
                                                $query5->with('blocks')->whereHas('blocks', fn($qu) => 
                                                    $qu->with('cemeteries')->whereHas('cemeteries', fn($que) => 
                                                        $que->where('name', 'LIKE', '%'.$this->search.'%')
                                                            ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                    )
                                                )
                                            )    
                                        )->paginate(3);
            }
            else
            {
                $graves = Grave::where('block_id', $this->filter_block_id)->get('id');
                $burials = Information::whereIn('grave_id', $graves)->with(['graves', 'deceased'])->where(fn($query) => 
                                            $query->whereHas('graves', fn($query2) => 
                                                $query2->where('name', 'LIKE','%'.$this->search.'%')
                                            )->orWhereHas('deceased', fn($query3) => 
                                                $query3->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                       ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                            )->orWhereHas('graves', fn($query4) => 
                                                $query4->with('blocks')->whereHas('blocks', fn($q) => 
                                                    $q->where('name->ar', 'LIKE', '%'.$this->search.'%')
                                                    ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                )
                                            )->orWhereHas('graves', fn($query5) =>
                                                $query5->with('blocks')->whereHas('blocks', fn($qu) => 
                                                    $qu->with('cemeteries')->whereHas('cemeteries', fn($que) => 
                                                        $que->where('name', 'LIKE', '%'.$this->search.'%')
                                                            ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                                                    )
                                                )
                                            )    
                                        )->paginate(3);
            }
            
        }else{
            $burials = Information::with(['graves', 'deceased'])->where(fn($query) => 
                $query->whereHas('graves', fn($query2) => 
                    $query2->where('name', 'LIKE','%' . $this->search . '%')
                )->orWhereHas('deceased', fn($query3) => 
                    $query3->where('name->ar', 'LIKE', '%'.$this->search.'%')
                           ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                )->orWhereHas('graves', fn($query4) => 
                    $query4->with('blocks')->whereHas('blocks', fn($q) => 
                        $q->where('name->ar', 'LIKE', '%'.$this->search.'%')
                          ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                    )
                )->orWhereHas('graves', fn($query5) =>
                    $query5->with('blocks')->whereHas('blocks', fn($qu) => 
                        $qu->with('cemeteries')->whereHas('cemeteries', fn($que) => 
                            $que->where('name', 'LIKE', '%'.$this->search.'%')
                                ->orWhere('name->en', 'LIKE', '%'.$this->search.'%')
                        )
                    )
                )
            )->paginate(3);
        }
        $genealoges = Genealogy::all();
        $relagens = Religion::all();
        $nationalities = Nationality::all();
        $gendors = Gander::all();
        $hospitals = Hospital::all();
        $cemeteries = Cemetery::all();
        $countries = Country::all();
        return view('livewire.graving.graving', [
            'genealoges' => $genealoges,
            'relagens' => $relagens,
            'nationalities' => $nationalities,
            'gendors' => $gendors,
            'hospitals' => $hospitals,
            'cemeteries' => $cemeteries,
            'burials' => $burials,
            'countries' => $countries
        ]);
    }


    public function getCity()
    {
        $this->filter_cityes = City::where('country_id', $this->filter_country_id)->get();
        $this->filterMode = true;
    }

    public function getCemetery()
    {
        $this->filter_cemeteries = Cemetery::where('citiy_id', $this->filter_city_id)->get();
    }

    public function filterGetBlocks()
    {
        $this->filter_blocks = Block::where('cemetery_id', $this->filter_cemetery_id)->get();
    }

    public function addMode()
    {
        $this->showTable = false;
    }

    public function close()
    {
        return redirect()->to('graving');
    }

    public function editMode($id)
    {
        $this->showTable = false;
        $this->editMode = true;
        $information = Information::findOrFail($id);
        $deceased = Dead::findOrFail($information->deceased_id);
        $guardian = Guardian::findOrFail($information->guardian_id);
        $hospital = Hospital::findOrFail($information->hospital_id);
        $grave = Grave::findOrFail($information->grave_id);

        $this->information_id = $information->id;
        $this->guardian_id = $guardian->id;
        $this->deceased_id = $deceased->id;
        $this->old_grave_id = $grave->id;

        //step one data
        $this->ft_name_ar = $deceased->getTranslation('name', 'ar');
        $this->s_name_ar = $deceased->getTranslation('father', 'ar');
        $this->t_name_ar = $deceased->getTranslation('grand_father', 'ar');
        $this->f_name_ar = $deceased->getTranslation('great_grand_father', 'ar');
        $this->ft_name_en = $deceased->getTranslation('name', 'en');
        $this->s_name_en = $deceased->getTranslation('father', 'en');
        $this->t_name_en = $deceased->getTranslation('grand_father', 'en');
        $this->f_name_en = $deceased->getTranslation('great_grand_father', 'en');
        $this->identity = $deceased->identity;
        $this->age = $deceased->age;
        $this->genealogy_id = $deceased->genealogy_id;
        $this->religin = $deceased->relagen_id;
        $this->nationality = $deceased->national_id;
        $this->gender = $deceased->gander_id;

        //step two data
        $this->guardian_name = $guardian->name;
        $this->phone = $guardian->phone_number;
        $this->email = $guardian->email;
        $this->address = $guardian->address;
        $this->dead_date = $information->date_of_death;
        $this->graving_date = $information->burial_date;
        $this->hospital = $hospital->id;
        $this->dead_reasone = $information->medical_diagnosis;

        //step three data
        $this->cemetery_id = $grave->blocks->cemetery_id;
        $this->block_id = $grave->block_id;
        $this->grave_id = $grave->id;
        $this->blocks = Block::where('cemetery_id', $grave->blocks->cemetery_id)->get();
        $this->graves = Grave::where('block_id', $grave->block_id)->where('status', 0)->orWhere('id', $this->old_grave_id)->get();
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
        $this->graves = Grave::where('block_id', $this->block_id)->where('status', 0)->get();
    }

    public function store()
    {
        DB::beginTransaction();
        try
        {
            $this->validate([
                'grave_id' => 'required'
            ]);

            if($this->editMode)
            {
                $deceased = Dead::findOrFail($this->deceased_id);
            }else{
                $deceased = new Dead();
            }
            $deceased->name = ['ar' => $this->ft_name_ar, 'en' => $this->ft_name_en];
            $deceased->father = ['ar' => $this->s_name_ar, 'en' => $this->s_name_en];
            $deceased->grand_father = ['ar' => $this->t_name_ar, 'en' => $this->t_name_en];
            $deceased->great_grand_father = ['ar' => $this->f_name_ar, 'en' => $this->f_name_en];
            $deceased->identity = $this->identity;
            $deceased->age = $this->age;
            $deceased->genealogy_id = $this->genealogy_id;
            $deceased->relagen_id = $this->religin;
            $deceased->national_id = $this->nationality;
            $deceased->gander_id = $this->gender;
            $deceased->save();

            if($this->editMode)
            {
                $guardian = Guardian::findOrFail($this->guardian_id);
            }else{
                $guardian = new Guardian();
            }
            $guardian->name = $this->guardian_name;
            $guardian->phone_number = $this->phone;
            $guardian->email = $this->email;
            $guardian->address = $this->address;
            $guardian->save();

            if($this->editMode)
            {
                $information = Information::findOrFail($this->information_id);
            }else{
                $information = new Information();
            }
            $information->deceased_id = $deceased->id;
            $information->guardian_id = $guardian->id;
            $information->hospital_id = $this->hospital;
            $information->grave_id = $this->grave_id;
            $information->medical_diagnosis = $this->dead_reasone;
            $information->date_of_death = $this->dead_date;
            $information->burial_date = $this->graving_date;
            $information->save();

            if($this->grave_id == $this->old_grave_id)
            {
                $grave = Grave::where('id', $this->old_grave_id)->first();
                $grave->status = 0;
                $grave->save();

                $grave = Grave::where('id', $this->grave_id)->first();
                $grave->status = 1;
                $grave->save();
            }else{
                $grave = Grave::where('id', $this->grave_id)->first();
                $grave->status = 1;
                $grave->save();
            }

            DB::commit();
            $this->clearForm();
            return redirect()->to('graving');
        }
        catch(\Illuminate\Validation\ValidationException  $e)
        {
            DB::rollBack();
            $validate = $e->validator;
            throw $e;
        }
    }

    public function delete($id)
    {
        $information = Information::findOrFail($id);
        $deceased = Dead::findOrFail($information->deceased_id);
        $guardian = Guardian::findOrFail($information->guardian_id);
        $information->delete();
        $deceased->delete();
        $guardian->delete();
        $grave = Grave::findOrFail($information->grave_id);
        $grave->status = 0;
        $grave->save();
        return redirect()->to('graving');
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
