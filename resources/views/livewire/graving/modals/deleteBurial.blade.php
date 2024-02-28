<div class="modal" id="delete{{$burial->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Delete Burial')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="text-danger">{{ __('Are You Sure About Deleting') }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" disabled value="{{$burial->graves->name}}" id="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-danger" type="button" wire:click="delete({{$burial->id}})">{{__('Delete')}}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>
