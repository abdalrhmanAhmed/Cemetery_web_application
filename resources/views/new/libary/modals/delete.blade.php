<!-- Large Modal -->
<div class="modal" id="delete{{ $libary->id }}">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Delete') }}</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('libary.destroy') }}" method="POST">
                    @csrf
                    {{-- @method('DELETE') --}}
                    <div class="row">
                        <div class="col-md">
                            <label for="">{{ __('Name') }}</label>
                            <input type="hidden" name="id" value="{{ $libary->id }}">
                            <input type="text" name="name" readonly value="{{ $libary->name }}"
                                class="form-control" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-danger" type="submit"><i
                        class="fa fa-trash"></i>{{ __('Delete') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal"
                    type="button">{{ __('Cancel') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--End Large Modal -->
