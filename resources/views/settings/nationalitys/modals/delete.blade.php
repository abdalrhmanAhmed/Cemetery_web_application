<!-- Basic modal -->
<div class="modal" id="delete{{$nationality->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Delete Nationality')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('gander.destroy', $nationality->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="text-center">
                        <h5 class="text-danger">{{ __('Are You Sure About Deleting') }}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">{{__('Nationality Name')}}</label>
                            <input type="text" name="name" value="{{$nationality->name}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-danger" type="sumbit">{{__('Delete')}}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->