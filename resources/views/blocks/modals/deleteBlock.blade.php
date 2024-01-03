<div class="modal" id="deleteBlock{{$block->id}}">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Delete Block')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('blocks.destroy', $block->id)}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <h4 class="text-danger">{{__('Are You Sure About Deleting')}}</h4>
        
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name_en" disabled id="name_en" value="{{$block->name}}"  required>
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