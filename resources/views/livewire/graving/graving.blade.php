<div>
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between">
            <strong>{{session()->get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a wire:click="moveStep(1)" type="button"
                   class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>{{ __('Deceased Data') }}</p>
            </div>
            <div class="stepwizard-step">
                <a  wire:click="moveStep(2)" type="button"
                   class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>{{ __('Guardian Info') }}</p>
            </div>
            <div class="stepwizard-step">
                <a  wire:click="moveStep(3)" type="button"
                   class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                   disabled="disabled">3</a>
                <p>{{__('Burial Location')}}</p>
            </div>
        </div>
    </div>

    @include('livewire.graving.steps.deceased_info')
    @include('livewire.graving.steps.guardian_info')
    @include('livewire.graving.steps.graving_info')
</div>
