<!-- Basic modal -->
<div class="modal" id="edit{{$city->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل مدينة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('city.update', $city->id)}}" method="POST">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">إسم مدينة بالعربية</label>
                            <input type="text" name="name_ar" value="{{$city->getTranslation('name', 'ar')}}" class="form-control" placeholder="إسم مدينة بالعربية" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">إسم مدينة بالإنجليزية</label>
                            <input type="text" name="name_en" value="{{$city->getTranslation('name', 'en')}}" class="form-control" placeholder="إسم مدينة بالإنجليزية" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="">الدولة</label>
                            <select name="country_id" class="form-control">
                                <option value="" selected disabled>-- حدد الدولة --</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}" {{$country->id == $city->country_id ? 'selected' : '' }}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-warning" type="sumbit">تعديل</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->