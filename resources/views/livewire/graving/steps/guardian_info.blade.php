@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-1">
@endif

    <div class="row">
        <div class="col-md-12 text-center">
            <h4>** بيانات الدافن **</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="">إسم الدافن (رباعي)</label>
            <input type="text" class="form-control {{ $errors->has('guardian_name') ? ' is-invalid' : '' }}" wire:model="guardian_name">
        </div>
        <div class="col-md-6">
            <label for="">رقم الهاتف</label>
            <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" wire:model="phone">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="">البريد الإلكتروني</label>
            <input type="text" class="form-control" wire:model="email">
        </div>
        <div class="col-md-6">
            <label for="">العنوان</label>
            <input type="text" class="form-control" wire:model="address">
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4>** بيانات الوفاة **</h4>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="">تاريخ الوفاة</label>
            <input type="date" class="form-control {{ $errors->has('dead_date') ? ' is-invalid' : '' }}" wire:model="dead_date" id="">
        </div>
        <div class="col-md-4">
            <label for="">تاريخ الدفن</label>
            <input type="date" class="form-control {{ $errors->has('graving_date') ? ' is-invalid' : '' }}" wire:model="graving_date" id="">
        </div>
        <div class="col-md-4">
            <label for="">المستشفى</label>
            <select wire:model="hospital" class="form-control {{ $errors->has('hospital') ? ' is-invalid' : '' }}" id="">
                <option value="" selected>-- حدد المستشفى --</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{$hospital->id}}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="">سبب الوفاة</label>
            <textarea wire:model="dead_reasone" class="form-control {{ $errors->has('dead_reasone') ? ' is-invalid' : '' }}"></textarea>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-12 d-flex justify-content-between">
            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="moveStep(1)">
                السابق
            </button>
            <button class="btn btn-success nextBtn btn-lg pull-right" type="button"
                    wire:click="moveStep(3)">التالي</button>
        </div>
    </div>

@if($currentStep != 2)
    </div>
@endif