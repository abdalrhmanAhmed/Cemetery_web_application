<div>
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between">
            <strong>{{session()->get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($showTable)
        <div class="row mb-4">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block" wire:click="addMode">{{ __('Add New Burial') }}</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="">{{ __('Country') }}</label>
                <select wire:model.lazy="filter_country_id" wire:change="getCity" class="form-control" id="">
                    <option value="" readonly>-- {{ __('Choose Country') }} --</option>
                    @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">

                <label for="">{{ __('City') }}</label>
                <select wire:model="filter_city_id" wire:change="getCemetery" class="form-control"  id="">
                    <option value="" selected>-- {{ __('Choose City') }} --</option>
                    @foreach ($filter_cityes as $city)
                        <option value="{{$city->id}}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">{{ __('Cemetery') }}</label>
                <select wire:model="filter_cemetery_id" wire:change="filterGetBlocks"  class="form-control" id="">
                    <option value="" selected>-- {{ __('Choose Cemetery') }} --</option>
                    @foreach ($filter_cemeteries as $cemetery)
                        <option value="{{$cemetery->id}}">{{ $cemetery->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">

                <label for="">{{ __('Block') }}</label>
                <select wire:model="filter_block_id" class="form-control"  id="">
                    <option value="" selected>-- {{ __('Choose Block') }} --</option>
                    @foreach ($filter_blocks as $block)
                        <option value="{{$block->id}}">{{ $block->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="">
            <div class="row mb-3 d-flex justify-content-end">
                {{-- <div class="col-md-1">
                    <select wire:model="pagenate" class="form-control" id="">
                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div> --}}
                <div class="col-md-3">
                    <input type="search" class="form-control" wire:model="search" placeholder="Search...">
                </div>
            </div>
            <table class="table text-md-nowrap table-bordered">
                <thead>
                    <tr>
                        <th class="wd-5p border-bottom-0">#</th>
                        <th class="wd-10p border-bottom-0">{{__('Cemetery')}}</th>
                        <th class="wd-10p border-bottom-0">{{__('Block')}}</th>
                        <th class="wd-15p border-bottom-0">{{__('Grave')}}</th>
                        <th class="wd-25p border-bottom-0">{{__('Buried')}}</th>
                        <th class="wd-25p border-bottom-0">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($burials as $burial)                                      
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $burial->graves->blocks->cemeteries->name }}</td>
                            <td>{{ $burial->graves->blocks->name }}</td>
                            <td>{{ $burial->graves->name }}</td>
                            <td>{{ $burial->deceased->getTranslation('name', app()->getLocale()) . ' ' . $burial->deceased->father . ' ' . $burial->deceased->grand_father . ' ' . $burial->deceased->great_grand_father}}</td>
                            <td>
                                <button class="btn btn-info btn-sm" wire:click="editMode({{$burial->id}})"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$burial->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('livewire.graving.modals.deleteBurial')
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <b>{{ __('Sorry!! No Data Found') }} ...</b>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $burials->links('pagination::bootstrap-4') }}
        </div>
    @else
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
    @endif
</div>
