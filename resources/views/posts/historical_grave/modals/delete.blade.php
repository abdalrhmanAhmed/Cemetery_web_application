<!-- Large Modal -->
<div class="modal" id="delete{{$historical_grave->id}}">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف قبر</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('historical_grave.destroy', $historical_grave->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md">
                            <label for="title">إسم المقبرة</label>
                            <input type="text" name="title" readonly value="{{$historical_grave->title}}" class="form-control" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-danger" type="submit"><i class="fa fa-trash"></i> حذف</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--End Large Modal -->