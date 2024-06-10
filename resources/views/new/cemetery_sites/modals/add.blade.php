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
                <form action="{{ route('cemetery-site.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4 mt-4">
                        <div class="col-md-6">
                            <label for="">{{ __('Name In Ar') }} :</label>
                            <input type="text" class="form-control" name="ar" placeholder="{{ __('Name In Ar') }}" required/>
                        </div>
                        <div class="col-md-6">
                            <label for="">{{ __('Name In En') }} :</label>
                            <input type="text" class="form-control" name="en" placeholder="{{ __('Name In En') }}" required/>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="">{{ __('Text') }} : </label>
                            <textarea name="text" class="form-control ckeditor" rows="10" cols="30" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="">{{ __("Image") }} :</label>
                            <input type="file" class="dropify" data-height="200" name="image" accept=".png" required/>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md">
                            <div class="map-container" style="margin: 2px;">
                                <div class="row map-input-fields">
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <div class="col-md map-input-with-no-padding">
                                                <label for=""> {{__('Latitude')}}</label>
                                                <input class="form-control" readonly name="latitude" type="text"><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <div class="col-md map-input-with-no-padding">
                                                <label for="">{{__('Longitude')}}</label>
                                                <input class="form-control" readonly  name="longitude" type="text"><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="map"></div>
                            </div>                      
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('Add New') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->