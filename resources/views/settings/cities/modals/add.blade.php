<!-- Basic modal -->
<div class="modal" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add City') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('city.store')}}" method="post">
                @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">{{ __('City Name By Arabic') }}</label>
                            <input type="text" name="name_ar" class="form-control" placeholder="{{ __('City Name By Arabic') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">{{ __('City Name By English') }}</label>
                            <input type="text" name="name_en" class="form-control" placeholder="{{ __('City Name By English') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="">{{__('Country')}}</label>
                            <select name="country_id" class="form-control">
                                <option value="" selected disabled>-- {{__('Choose Country')}} --</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-info" type="sumbit">{{__('Save')}}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->