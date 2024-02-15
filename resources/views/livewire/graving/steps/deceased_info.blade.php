@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif


<div class="row mb-3">
    <div class="col-md-3">
        <label for="">{{__('First Name By Arabic')}}</label>
        <input type="text" class="form-control {{ $errors->has('ft_name_ar') ? ' is-invalid' : '' }}" wire:model="ft_name_ar" id="">
    </div>
    <div class="col-md-3">
        <label for="">{{__('Second Name By Arabic')}}</label>
        <input type="text" class="form-control {{ $errors->has('s_name_ar') ? ' is-invalid' : '' }}" wire:model="s_name_ar" id="">
    </div>
    <div class="col-md-3">
        <label for="">{{__('Third Name By Arabic')}}</label>
        <input type="text" class="form-control {{ $errors->has('t_name_ar') ? ' is-invalid' : '' }}" wire:model="t_name_ar" id="">
    </div>
    <div class="col-md-3">
        <label for="">{{__('Fourth Name By Arabic')}}</label>
        <input type="text" class="form-control {{ $errors->has('f_name_ar') ? ' is-invalid' : '' }}" wire:model="f_name_ar" id="">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3">
        <label for="">{{__('First Name By English')}}</label>
        <input type="text" class="form-control {{ $errors->has('ft_name_en') ? ' is-invalid' : '' }}" wire:model="ft_name_en" id="">
    </div>
    <div class="col-md-3">
        <label for="">{{__('Second Name By English')}}</label>
        <input type="text" class="form-control {{ $errors->has('s_name_en') ? ' is-invalid' : '' }}" wire:model="s_name_en" id="">
    </div>
    <div class="col-md-3">
        <label for="">{{__('Third Name By English')}}</label>
        <input type="text" class="form-control {{ $errors->has('t_name_en') ? ' is-invalid' : '' }}" wire:model="t_name_en" id="">
    </div>
    <div class="col-md-3">
        <label for="">{{__('Fourth Name By English')}}</label>
        <input type="text" class="form-control {{ $errors->has('f_name_en') ? ' is-invalid' : '' }}" wire:model="f_name_en" id="">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <label for="">{{__('ID Number')}}</label>
        <input type="text" class="form-control {{ $errors->has('identity') ? ' is-invalid' : '' }}" wire:model="identity" id="">
    </div>
    <div class="col-md-4">
        <label for="">{{ __('Age') }}</label>
        <input type="number" class="form-control {{ $errors->has('age') ? ' is-invalid' : '' }}" wire:model="age" id="">
    </div>
    {{-- <div class="col-md-4">
        <label for="">{{__('Genealogy')}}</label>
        <select wire:model="genealogy_id" class="form-control {{ $errors->has('genealogy_id') ? ' is-invalid' : '' }}" id="">
            <option value="" selected>-- {{__('Choose Genealogy')}} --</option>
            @foreach ($genealoges as $genealog)
                <option value="{{$genealog->id}}">{{$genealog->name}}</option>
            @endforeach
        </select>
    </div> --}}
    <div class="col-md-4">
        <label for="">{{__('Gender')}}</label>
        <select wire:model="gender" class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" id="">
            <option value="" selected>-- {{__('Choose Gender')}} --</option>
            @foreach ($gendors as $gender)
                <option value="{{$gender->id}}">{{ $gender->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <label for="">{{__('Religion')}}</label>
        <select wire:model="religin" class="form-control {{ $errors->has('religin') ? ' is-invalid' : '' }}" id="">
            <option value="" selected>-- {{__('Choose Religion')}} --</option>
            @foreach ($relagens as $relagen)
                <option value="{{$relagen->id}}">{{ $relagen->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="">{{__('Nationality')}}</label>
        <select wire:model="nationality" class="form-control {{ $errors->has('nationality') ? ' is-invalid' : '' }}" id="">
            <option value="" selected>-- {{__('Choose Nationality')}} --</option>
            @foreach ($nationalities as $national)
                <option value="{{$national->id}}">{{ $national->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row ">
    <div class="col-md-12 d-flex justify-content-between">
        <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="close">
            {{__('Close')}}
        </button>
        <button class="btn btn-success nextBtn btn-lg pull-right" type="button"
                wire:click="moveStep(2)">{{__('Next')}}</button>
    </div>
</div>
@if($currentStep != 1)
    </div>
@endif