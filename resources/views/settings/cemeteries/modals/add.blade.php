<!-- Large Modal -->
<div class="modal" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة مقبرة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('cemetery.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md">
                            <label for="">إسم المقبرة</label>
                            <input type="text" name="name" placeholder="إسم المقبرة" class="form-control" required>
                        </div>
                        <div class="col-md">
                            <label for="">الدولة</label>
                            <select name="country_id" class="form-control" required>
                               <option value="0">_._._</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">المدينة</label>
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
                                    <label for=""> خط العرض</label>
                                    <input class="form-control" readonly name="latitude" type="text"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group row">
                                <div class="col-md map-input-with-no-padding">
                                    <label for="">خط الطول</label>
                                    <input class="form-control" readonly  name="longitude" type="text"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-info" type="submit"><i class="fa fa-plus"></i> إضافة</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--End Large Modal -->