<!-- Large Modal -->
<div class="modal" id="edit{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add New') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div>
                </div>
                <form action="{{ route('DailyDeathController.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="">{{ __("Name of the deceased") }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $item->dead_name }}" required>
                        </div>
                        <div class="col-md">
                            <label for="">{{ __("Nationality") }}</label>
                            <input type="text" name="nationality" class="form-control" value="{{ $item->nationalaty }}" required>
                        </div>
                        <div class="col-md">
                            <label for="">{{ __("the age") }}</label>
                            <input type="number" name="age" class="form-control" value="{{ $item->age }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">    
                        <div class="col-md">
                            <label for="">{{ __("Burial day") }}</label>
                            <select name="day" class="form-control" required>
                                <option value="0" disabled >_._._</option>
                                <option {{ $item->day ==  __("Saturday")  ? 'selected' : '' }}value='{{ __("Saturday") }}'>{{ __("Saturday") }}</option>
                                <option {{ $item->day ==  __("Sunday")  ? 'selected' : '' }}value='{{ __("Sunday") }}'>{{ __("Sunday") }}</option>
                                <option {{ $item->day ==  __("Monday")  ? 'selected' : '' }}value='{{ __("Monday") }}'>{{ __("Monday") }}</option>
                                <option {{ $item->day ==  __("Tuesday")  ? 'selected' : '' }}value='{{ __("Tuesday") }}'>{{ __("Tuesday") }}</option>
                                <option {{ $item->day ==  __("Wednesday")  ? 'selected' : '' }}value='{{ __("Wednesday") }}'>{{ __("Wednesday") }}</option>
                                <option {{ $item->day ==  __("Thursday")  ? 'selected' : '' }}value='{{ __("Thursday") }}'>{{ __("Thursday") }}</option>
                                <option {{ $item->day ==  __("Friday")  ? 'selected' : '' }}value='{{ __("Friday") }}'>{{ __("Friday") }}</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">{{ __("Burial date") }}</label>
                            <input type="date" name="date" class="form-control" value="{{ $item->pray_date }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="">{{ __("Burial notes") }}</label>
                            <textarea type="text" name="notes" class="form-control" rows="10" required >{{ $item->pray_note }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">{{ __('Edit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->