<!-- Large Modal -->
<div class="modal" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Add Cemetery')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('cemetery.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">{{__('Cemetery Name By Arabic')}}</label>
                            <input type="text" name="name_ar" placeholder="{{__('Cemetery Name By Arabic')}}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">{{__('Cemetery Name By English')}}</label>
                            <input type="text" name="name_en" placeholder="{{__('Cemetery Name By English')}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">{{__('Countery')}}</label>
                            <select name="country_id" class="form-control" required>
                               <option value="0">_._._</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">{{__('City')}}</label>
                            <select name="city_id" class="form-control" required>
                            </select>
                        </div>
                    </div>
                    <br>
                <div class="map-container" style="margin: 2px;">
                    <div class="row map-input-fields">
                        <div class="col-md">
                            <div class="form-group row">
                                <div class="col-md map-input-with-no-padding">
                                    <label for=""> {{__('Latitude')}}</label>
                                    <input class="form-control" readonly name="latitude" type="text"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group row">
                                <div class="col-md map-input-with-no-padding">
                                    <label for="">{{__('Longitude')}}</label>
                                    <input class="form-control" readonly  name="longitude" type="text"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-info" type="submit"><i class="fa fa-plus"></i> {{__('Save')}}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--End Large Modal -->