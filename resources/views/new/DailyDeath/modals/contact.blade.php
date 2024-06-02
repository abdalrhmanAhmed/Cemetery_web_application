<!-- Large Modal -->
<div class="modal" id="contact{{$item->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Contacts') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action='{{route("DailyDeathDetailsController.store",$item->id)}}' method="POST">
                            @csrf
                            {{-- @method('DELETE') --}}
                            <div class="row">
                                <div class="col-md">
                                    <label for="">{{ __('Type') }}</label>
                                    <select name="type" id="" class="form-control">
                                        <option value="0" disabled selected>_._._</option>
                                        @foreach ($CondolencesMethod as $item1)
                                            <option value="{{ $item1['key'] }}">{{ $item1['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="">{{ __("Value") }}</label>
                                    <input type="text" name="value" placeholder='{{ __("Value") }}' class="form-control">
                                </div>
                            </div>
            
                    </div>
                    <div class="card-footer">
                        <button class="btn ripple btn-success" type="submit"><i class="fa fa-plus"></i> {{ __('Add') }}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ __('Cancel') }}</button>
                    </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-body">
                        @forelse (App\Models\DailyDeathsDetail::where("daily_death_id", $item->id)->get() as $item)                          
                        <div class="row">

                            <div class="col-md">
                                <h5>
                                    @foreach ($CondolencesMethod as $contactmethod)
                                        {{ $contactmethod['key'] == $item->key ? $contactmethod['value'] : ""}}
                                    @endforeach
                                </h5>
                            </div>

                            <div class="col-md">
                                <p>{{ $item->value }}</p>
                            </div>

                            <div class="col-md">
                                <span>
                                    <a href="{{ route('DailyDeathDetailsController.delete', $item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ __("Delete") }}</a>
                                </span>
                            </div>
                        </div>
                        <hr>
                        @empty
                            <br>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->