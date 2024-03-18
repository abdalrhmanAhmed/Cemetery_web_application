<!-- Large Modal -->
<div class="modal" id="show{{$historical_grave->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">نبذة عن صاحب القبر</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md">
                        <label for="name_ar">نبذة عن صاحل القبر التاريخي</label>
                        <textarea name="text" class="form-control ckeditor" cols="30" rows="10" readonly>
                            {!! $historical_grave->text !!}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->