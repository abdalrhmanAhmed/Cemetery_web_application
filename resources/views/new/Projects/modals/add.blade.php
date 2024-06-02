<!-- Large Modal -->
<div class="modal" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add New') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <h6 class="card-title mb-1">{{ __('Data to Know') }}</h6>
                    <p class="text-muted card-sub-title">{{ __('Please adhere to the type of image suffix') }} (<code>PNG.</code>)</p>
                </div>
                <form action="{{ route('ProjectsController.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
                            <div class="row">
                                <div class="col-md">
                                    <label for="">{{ __('Name In Ar') }}</label>
                                    <input type="text" class="form-control" name="ar" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="">{{ __('Name In En') }}</label>
                                    <input type="text" class="form-control" name="en" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <input type="file" class="dropify" data-height="200" name="image" accept=".png" required/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('Add New') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->