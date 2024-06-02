<!-- Large Modal -->
<div class="modal" id="text">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add New') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('text.cemetery-site',$cemetery_sites->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <textarea name="value" class="form-control ckeditor" required></textarea>
                    <br>
                    <button type="submit" class="btn btn-success">{{ __('Add New') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->