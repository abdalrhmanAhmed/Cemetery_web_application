<div class="modal" id="deleteGrave{{$grave->id}}">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القبر</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('graves.destroy', $grave->id)}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <h4 class="text-danger">هل أنت متأكد من عملية الحذف ؟؟</h4>
        
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name_en" disabled id="name_en" value="{{$grave->name}}"  required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-danger" type="submit">حذف</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>