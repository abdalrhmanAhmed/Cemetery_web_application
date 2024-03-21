<div class="modal" id="delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Delete Grave')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('ExcelShow.delete')}}" class="form" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="text-danger">{{__('Are you sure you want to delete this grave?')}}</h4>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="id" hidden id="id">
                            <input type="text" class="form-control" readonly id="name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-danger" type="submit" disabled id="btn-delete">{{__('Delete')}}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>