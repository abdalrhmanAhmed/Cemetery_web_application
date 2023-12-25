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
                    <div class="row">
                        <div class="col-md">
                            <label for="">إسم الدولة</label>
                            <input type="text" name="name" value="{{$city->name}}" class="form-control" placeholder="إسم الدولة" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">الدولة</label>
                            <select name="country_id" class="form-control">
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