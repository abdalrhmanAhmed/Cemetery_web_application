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
                    <div class="row">
                        <div class="col-md">
                            <label for="">إسم الدولة</label>
                            <input type="text" name="name" value="{{$country->name}}" class="form-control" placeholder="إسم الدولة" required>
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