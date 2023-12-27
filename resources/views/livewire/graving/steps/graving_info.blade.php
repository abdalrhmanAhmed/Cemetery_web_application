@if($currentStep != 3)
    <div style="display: none" class="row setup-content" id="step-1">
@endif

<div class="row mb-4">
    <div class="col-md-12 text-center">
        <h3 class="text-danger">الرجاء التأكد من جميع البيانات المدخلة قبل الحفظ !!</h3>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <label for="">المقبرة</label>
        <select class="form-control" wire:model="cemetery_id" wire:change="getBlocks" id="">
            <option value="" selected>-- حدد المقبرة --</option>
            @foreach ($cemeteries as $cemetery)
                <option value="{{$cemetery->id}}">{{ $cemetery->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="">المجمع</label>
        <select class="form-control" wire:model="block_id" wire:change="getGraves" id="">
            <option value="" selected>-- حدد المجمع --</option>
            @foreach ($blocks as $block)
                <option value="{{$block->id}}">{{ $block->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="">القبر</label>
        <select class="form-control {{ $errors->has('grave_id') ? ' is-invalid' : '' }}" wire:model="grave_id" wire:change="getBlocks" id="">
            <option value="" selected>-- حدد القبر --</option>
            @foreach ($graves as $grave)
                <option value="{{$grave->id}}">{{ $grave->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row ">
    <div class="col-md-12 d-flex justify-content-between">
        <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="moveStep(2)">
            السابق
        </button>
        <button class="btn btn-success nextBtn btn-lg pull-right" type="button"
                wire:click="store">حفظ البيانات</button>
    </div>
</div>

@if($currentStep != 3)
    </div>
@endif