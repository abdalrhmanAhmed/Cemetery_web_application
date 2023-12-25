<!-- Basic modal -->
<div class="modal" id="edit{{$quote->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل الإجراء</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('quote.update', $quote->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md">
                        <label for="">عنوان الحديث</label>
                        <input type="text" name="title" class="form-control" value="{{$quote->title}}" placeholder="عوان الإجراء" required>
                    </div>
                    <div class="col-md">
                        <label for="">عنوان الفرعي</label>
                        <input type="text" name="sub_title" class="form-control" value="{{$quote->sub_title}}" placeholder="إسم الإجراء الفرعي" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">المحتوى</label>
                        <textarea name="text"  class="form-control" cols="30" rows="10" required>{{$quote->text}}</textarea>
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