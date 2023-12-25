<!-- Large Modal -->
<div class="modal" id="edit{{$cemeterie->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل مقبرة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('cemetery.update', $cemeterie->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md">
                            <label for="">إسم المقبرة</label>
                            <input type="text" name="name" value="{{$cemeterie->name}}" placeholder="إسم المقبرة" class="form-control" required>
                        </div>
                        <div class="col-md">
                            <label for="">الدولة</label>
                            <select name="country_id" class="form-control" required>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}" {{$country->id == $cemeterie->cities->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $cities = App\Models\City::where('country_id', $cemeterie->cities->country_id)->first();
                        @endphp
                        <div class="col-md">
                            <label for="">المدينة</label>
                            <select name="city_id" class="form-control" required>
                                <option value="{{$cities->id}}">{{$cities->name}}</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="map-container" style="margin: 2px;">
                    <div class="row map-input-fields">
                        <div class="col-md">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="short_name_input">
                                <span class="arabic ar_f">خط العرض</span>
                                <br>
                                <span class="english en_f">Latitude</span>
                                </label>
                                <div class="col-sm-7 map-input-with-no-padding">
                                    <input class="form-control" value="{{$cemeterie->latitude}}" readonly  name="latitude" type="text"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="short_name_input">
                                <span class="arabic ar_f">خط الطول</span>
                                <br>
                                <span class="english en_f">Longitude</span>
                                </label>
                                <div class="col-sm-7 map-input-with-no-padding">
                                    <input class="form-control" value="{{$cemeterie->Longitude}}" readonly  name="longitude" type="text"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div id="map2"></div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-warning" type="submit"><i class="fa fa-edit"></i> تعدسل</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--End Large Modal -->