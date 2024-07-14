<!-- Large Modal -->
<div class="modal" id="files{{ $cemetery_site->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Files') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        @forelse (App\Models\BurialExcel::select('file_name')->distinct()->get() as $item)
                            <div class="row">
                                <div class="col-md">
                                    <a href="{{ route('download-file', ['file_name' => $item->file_name]) }}"
                                        target="_blank">
                                        {{ $item->file_name }}
                                    </a>
                                </div>
                            </div>
                            <hr>
                        @empty
                            <p>No files found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Large Modal -->
