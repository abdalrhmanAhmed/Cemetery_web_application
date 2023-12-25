<!-- Basic modal -->
<div class="modal" id="edit{{$procedure->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل الإجراء</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('procedure.update', $procedure->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md">
                        <label for="">عنوان الإجراء</label>
                        <input type="text" name="title" class="form-control" value="{{$procedure->title}}" placeholder="عوان الإجراء" required>
                    </div>
                    <div class="col-md">
                        <label for="">عنوان الإجراء الفرعي</label>
                        <input type="text" name="sub_title" class="form-control" value="{{$procedure->sub_title}}" placeholder="إسم الإجراء الفرعي" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">المحتوى</label>
                        <textarea name="text"  class="form-control" cols="30" rows="10" required>{{$procedure->text}}</textarea>
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