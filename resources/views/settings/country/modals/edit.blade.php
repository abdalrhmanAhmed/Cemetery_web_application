<!-- Basic modal -->
<div class="modal" id="edit{{$country->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل دولة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('country.update', $country->id)}}" method="POST">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">إسم الدولة بالعربية</label>
                            <input type="text" name="name_ar" value="{{$country->getTranslation('name', 'ar')}}" class="form-control" placeholder="إسم الدولة بالعربية" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">إسم الدولة بالإنجليزية</label>
                            <input type="text" name="name_en" value="{{$country->getTranslation('name', 'en')}}" class="form-control" placeholder="إسم الدولة بالإنجليزية" required>
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