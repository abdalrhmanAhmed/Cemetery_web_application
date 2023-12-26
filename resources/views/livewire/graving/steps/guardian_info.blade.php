@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-1">
@endif

    


    <div class="row ">
        <div class="col-md-12 d-flex justify-content-between">
            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="moveStep(1)">
                السابق
            </button>
            <button class="btn btn-success nextBtn btn-lg pull-right" type="button"
                    wire:click="moveStep(2)">التالي</button>
        </div>
    </div>

@if($currentStep != 2)
    </div>
@endif