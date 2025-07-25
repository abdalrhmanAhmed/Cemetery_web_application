<!-- Large Modal -->
<div class="modal" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add New') }}</h6><button aria-label="Close" class="close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('AboutTheOfficeOfCemeteriesAffairController.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="">{{ __('Name In Ar') }}</label>
                            <input type="text" class="form-control" name="ar" required />
                        </div>
                        <div class="col-md-6">
                            <label for="">{{ __('Name In En') }}</label>
                            <input type="text" class="form-control" name="en" required />
                        </div>
                    </div>
                    <div>
                        <h6 class="card-title mb-1">{{ __('Data to Know') }}</h6>
                        <p class="text-muted card-sub-title">{{ __('Please adhere to the type of image suffix') }}
                            (<code>PNG.</code>)</p>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="file" class="dropify" data-height="200" name="image" accept=".png"
                                required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">{{ __('Add New') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->
