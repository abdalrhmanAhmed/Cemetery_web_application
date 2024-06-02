<!-- Large Modal -->
<div class="modal" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add New') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('DailyDeathController.store',1) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="">{{ __("Name of the deceased") }}</label>
                            <input type="text" name="name" class="form-control" placeholder='{{ __("Name of the deceased") }}' required>
                        </div>
                        <div class="col-md">
                            <label for="">{{ __("Nationality") }}</label>
                            <input type="text" name="nationality" class="form-control" placeholder='{{ __("Nationality") }}' required>
                        </div>
                        <div class="col-md">
                            <label for="">{{ __("the age") }}</label>
                            <input type="number" name="age" class="form-control" placeholder="20,30,50,...." required>
                        </div>
                    </div>
                    <div class="row mb-4">    
                        <div class="col-md">
                            <label for="">{{ __("Burial day") }}</label>
                            <select name="day" class="form-control" required>
                                <option value="0" disabled selected>_._._</option>
                                <option value='{{ __("Saturday") }}'>{{ __("Saturday") }}</option>
                                <option value='{{ __("Sunday") }}'>{{ __("Sunday") }}</option>
                                <option value='{{ __("Monday") }}'>{{ __("Monday") }}</option>
                                <option value='{{ __("Tuesday") }}'>{{ __("Tuesday") }}</option>
                                <option value='{{ __("Wednesday") }}'>{{ __("Wednesday") }}</option>
                                <option value='{{ __("Thursday") }}'>{{ __("Thursday") }}</option>
                                <option value='{{ __("Friday") }}'>{{ __("Friday") }}</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">{{ __("Burial date") }}</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="">{{ __("Burial notes") }}</label>
                            <textarea type="text" name="notes" class="form-control" rows="10" required placeholder="{{__('After Friday prayers, Omar bin Abdulaziz Mosque - Burial Ground, Fujairah Cemetery')}}"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('Add New') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->