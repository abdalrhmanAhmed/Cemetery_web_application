<!-- Basic modal -->
<div class="modal" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Add Hadith')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('quote.store')}}" method="post">
                @csrf
                    <div class="row">
                        <div class="col-md">
                            <label for="">{{__('Bold Title')}}</label>
                            <input type="text" name="title" class="form-control"  required>
                        </div>
                        <div class="col-md">
                            <label for="">{{__('Subhead')}}</label>
                            <input type="text" name="sub_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">{{__('Content')}}</label>
                            <textarea name="text" class="form-control ckeditor" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-info" type="sumbit">{{__('Save')}}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->