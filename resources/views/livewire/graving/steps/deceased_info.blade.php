@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif


<div class="row mb-3">
    <div class="col-md-3">
        <label for="">إسم الأول بالعربية</label>
        <input type="text" class="form-control" name="ft_name_ar" id="">
    </div>
    <div class="col-md-3">
        <label for="">إسم الثاني بالعربية</label>
        <input type="text" class="form-control" name="s_name_ar" id="">
    </div>
    <div class="col-md-3">
        <label for="">إسم الثالث بالعربية</label>
        <input type="text" class="form-control" name="t_name_ar" id="">
    </div>
    <div class="col-md-3">
        <label for="">إسم الرابع بالعربية</label>
        <input type="text" class="form-control" name="f_name_ar" id="">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3">
        <label for="">إسم الأول بالإنجليزية</label>
        <input type="text" class="form-control" name="ft_name_en" id="">
    </div>
    <div class="col-md-3">
        <label for="">إسم الأول بالإنجليزية</label>
        <input type="text" class="form-control" name="s_name_en" id="">
    </div>
    <div class="col-md-3">
        <label for="">إسم الأول بالإنجليزية</label>
        <input type="text" class="form-control" name="t_name_en" id="">
    </div>
    <div class="col-md-3">
        <label for="">إسم الأول بالإنجليزية</label>
        <input type="text" class="form-control" name="f_name_en" id="">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <label for="">رقم الهوية</label>
        <input type="text" class="form-control" name="identity" id="">
    </div>
    <div class="col-md-4">
        <label for="">العمر</label>
        <input type="number" class="form-control" name="age" id="">
    </div>
    <div class="col-md-4">
        <label for="">النسب</label>
        <select name="" class="form-control" id="">
            <option value="" selected>-- حدد النسب --</option>
            @foreach ($genealoges as $genealog)
                <option value="{{$genealog->id}}">{{$genealog->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <label for="">الديانة</label>
        <select name="" class="form-control" id="">
            <option value="" selected>-- حدد الديانة --</option>
            @foreach ($relagens as $relagen)
                <option value="{{$relagen->id}}">{{ $relagen->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="">الجنسية</label>
        <select name="" class="form-control" id="">
            <option value="" selected>-- حدد الجنسية --</option>
            @foreach ($nationalities as $national)
                <option value="{{$national->id}}">{{ $national->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="">الجنس</label>
        <select name="" class="form-control" id="">
            <option value="" selected>-- حدد الجنس --</option>
            @foreach ($gendors as $gender)
                <option value="{{$gender->id}}">{{ $gender->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row ">
    <div class="col-md-12 d-flex justify-content-end">
        <button class="btn btn-success nextBtn btn-lg pull-right" type="button"
                wire:click="moveStep(2)">التالي</button>
    </div>
</div>
@if($currentStep != 1)
    </div>
@endif