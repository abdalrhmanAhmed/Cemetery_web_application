<!-- Large Modal -->
<div class="modal" id="contact{{$cemetery_site->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Contacts') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action='{{route("contact.store",$cemetery_site->id)}}' method="POST">
                            @csrf
                            {{-- @method('DELETE') --}}
                            <div class="row">
                                <div class="col-md">
                                    <label for="">{{ __('Type') }}</label>
                                    <select name="type" id="" class="form-control">
                                        <option value="0" disabled selected>_._._</option>
                                        @foreach ($contactMethod as $item)
                                            <option value="{{ $item['key'] }}">{{ $item['value'] }}</option>
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
                        @forelse (App\Models\CemeterySitesContact::where("cemetery_sites_id", $cemetery_site->id)->get() as $item)                          
                        <div class="row">

                            <div class="col-md">
                                <h5>
                                    @foreach ($contactMethod as $contactmethod)
                                        {{ $contactmethod['key'] == $item->type ? $contactmethod['value'] : ""}}
                                    @endforeach
                                </h5>
                            </div>

                            <div class="col-md">
                                <p>{{ $item->value }}</p>
                            </div>

                            <div class="col-md">
                                <span>
                                    <a href="{{ route('contact.delete', $item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ __("Delete") }}</a>
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