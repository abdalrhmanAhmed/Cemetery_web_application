<!-- Basic modal -->
<div class="modal" id="delete{{$country->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف دولة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('country.destroy', $country->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="text-center">
                    <i class="text-danger">هل انت متأكد من عملية الحذف</i>
                </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">إسم الدولة</label>
                            <input type="text" name="name" value="{{$country->name}}" class="form-control" placeholder="إسم الدولة" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-danger" type="sumbit">حذف</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->