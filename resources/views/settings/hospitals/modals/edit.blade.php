<!-- Basic modal -->
<div class="modal" id="edit{{$hospital->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Edit Hospital')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('hospital.update', $hospital->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">{{__('Hospital Name By Arabic')}}</label>
                            <input type="text" name="name_ar" value="{{$hospital->getTranslation('name', 'ar')}}" class="form-control" placeholder="{{__('Hospital Name By Arabic')}}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="">{{__('Hospital Name By English')}}</label>
                            <input type="text" name="name_en" value="{{$hospital->getTranslation('name', 'en')}}" class="form-control" placeholder="{{__('Hospital Name By English')}}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-warning" type="sumbit">{{__('Edit')}}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->