<!-- Large Modal -->
<div class="modal" id="upload">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add New') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <h6 class="card-title mb-1">{{ __('Data to Know') }}</h6>
                    <p class="text-muted card-sub-title">{{ __('Please adhere to the type of files suffix') }} (<code>PNG.,JPG.,JPEG,MP4.,MP3.,WEBM</code>)</p>
                </div>
                <br>
                <form action="{{ route('upload.AboutTheOfficeOfCemeteriesAffairDetailsController',$libary->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    {{ __('Please select the type') }}
                                </div>
                                <p class="mg-b-20">{{ __('Please select the type of file you want to upload') }}</p>
                                <div class="row mg-t-10">
                                    <div class="col-lg-3">
                                        <label class="rdiobox"><input checked name="type" type="radio" value="1"> <span>{{ __('Video') }}</span></label>
                                    </div>
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                        <label class="rdiobox"><input  name="type" type="radio" value="2"> <span>{{ __('Voice') }}</span></label>
                                    </div>
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                        <label class="rdiobox"><input  name="type" type="radio" value="3"> <span>{{ __('image') }}</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12 col-md-12">
                            <input type="file" class="dropify" data-height="200" name="file" accept=".png,.jpg,.jpeg,.mp4,.mp3,.webm" required/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('Add New') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->