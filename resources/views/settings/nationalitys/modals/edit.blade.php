<!-- Basic modal -->
<div class="modal" id="edit{{$nationality->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Edit Nationality')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('nationality.update', $nationality->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">{{__('Nationality Name By Arabic')}}</label>
                            <input type="text" name="name_ar" value="{{$nationality->getTranslation('name', 'ar')}}" class="form-control" placeholder="{{__('Nationality Name By Arabic')}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">{{__('Nationality Name By English')}}</label>
                            <input type="text" name="name_en" value="{{$nationality->getTranslation('name', 'en')}}" class="form-control" placeholder="{{__('Nationality Name By English')}}" required>
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