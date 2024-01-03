<!-- Large Modal -->
<div class="modal" id="delete{{$cemeterie->id}}">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Delete Cemetery')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('cemetery.destroy', $cemeterie->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5 class="text-danger">{{ __('Are You Sure About Deleting') }}</h5>
                        </div>
                        <div class="col-md">
                            <label for="">{{__('Cemetery Name')}}</label>
                            <input type="text" name="name" readonly value="{{$cemeterie->name}}" class="form-control" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-danger" type="submit">{{__('Delete')}}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--End Large Modal -->