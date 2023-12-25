<!-- Large Modal -->
<div class="modal" id="edit{{$contact->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل وسيلة التواصل</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('contact.update', $contact->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md">
                            <label for="">إسم وسيلة التواصل</label>
                            <input type="text" name="name" value="{{$contact->name}}" placeholder="إسم المقبرة" class="form-control" required>
                        </div>
                        {{-- <div class="col-md">
                            <label for="">الدولة</label>
                            <select name="country_id" class="form-control" required>
                                @foreach ($contacts as $country)
                                    <option value="{{$country->id}}" {{$contacts->id == $contact->id ? 'selected' : ''}}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <div class="row">
                        @php
                            $contacts = App\Models\Contact::where('id', $contact->id)->first();
                        @endphp
                        {{-- <div class="col-md">
                            <label for="">وسيلة التواصل</label>
                            <select name="city_id" class="form-control" required>
                                <option value="{{$contacts->id}}">{{$contacts->name}}</option>
                            </select>
                        </div> --}}
                    </div>
                    <br>
                    <div class="map-container" style="margin: 2px;">
                    <div class="row map-input-fields">
                        <div class="col-md">
                            <div class="form-group row">
                                <div class="col-md map-input-with-no-padding">
                                    <label>الرابط </label>
                                    <input class="form-control" value="{{$contacts->url}}"   name="url" type="text"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group row">
                                <div class="col-md map-input-with-no-padding">
                                    <label>الايقونة </label>
                                    <input class="form-control" value="{{$contacts->icon}}"   name="icon" type="file"><br>
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