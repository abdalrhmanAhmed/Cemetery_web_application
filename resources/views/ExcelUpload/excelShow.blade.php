@extends('layouts.master')
@section('css')
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.0/css/select.dataTables.css">
<style>
	div.dt-container div.dt-layout-cell.dt-start
	{
		text-align: right !important;
	}
	div.dt-container div.dt-layout-cell.dt-end
	{
		text-align: left !important;
	}

</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto" style="font-family: Cairo">{{__('Burials')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0" style="font-family: Cairo">/ {{__('Burials List')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="row">
                                    {{-- <div class="col-md-12 mb-4">
                                        <form action="{{ route('ExcelShow.upload') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">{{ __('Upload Excel File') }}</label>
                                                    <input type="file" name="csv" class="form-control" id="">
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-success" style="margin-top: 28px"><i class="fa fa-upload"></i> {{  __('Upload')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <h4 class="card-title mg-b-0" style="font-family: Cairo">{{__('Burials List')}}</h4>
                                    </div>
								</div>
							</div>
							<div class="card-body">
								<form action="{{route('ExcelShow.filtter')}}" method="GET">
									@csrf
									<div class="row mb-4">
										<div class="col-md-4">
											<label for="">{{ __('Cemetry') }}</label>
											<select name="cemetery_id" id="cemetery_id" class="form-control select2">
												<option value="">{{ __('Choose Cemetery') }}</option>
												@foreach ($cemetries as $cemetery)
													<option value="{{ $cemetery->id }}">{{ $cemetery->name }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-4">
											<button type="submit" class="btn btn-success" style="margin-top: 27px;">{{ __('Search') }}</button>
										</div>
									</div>
								</form>
								<form action="{{route('ExcelShow.bulck_delete')}}" method="POST">
									@csrf
									<div class="row mb-3">
										<div class="col-md-12">
											<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete Selected Rows') }}</button>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table display" id="example">
											<thead>
												<tr>
													<th class="wd-5p border-bottom-0 no-sort"><input type="checkbox" id="check-all" title="{{__('Check All')}}"></th>
													<th class="wd-5p border-bottom-0">#</th>
													<th class="wd-25p border-bottom-0">{{ __('Burial Name') }}</th>
													<th class="wd-20p border-bottom-0">{{ __('Nationality') }}</th>
													<th class="wd-15p border-bottom-0">{{ __('Country') }}</th>
													<th class="wd-20p border-bottom-0">{{ __('City') }}</th>
													<th class="wd-20p border-bottom-0">{{ __('Sector') }}</th>
													<th class="wd-10p border-bottom-0">{{ __('Cemetry') }}</th>
													<th class="wd-20p border-bottom-0">{{ __('Hospital') }}</th>
													<th class="wd-20p border-bottom-0">{{ __('Death Date') }}</th>
													<th class="wd-20p border-bottom-0">{{ __('Burial Date') }}</th>
													<th class="wd-25p border-bottom-0">{{ __('Grave Code') }}</th>
													<th class="wd-25p border-bottom-0">{{ __('Actions') }}</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($burials as $item)
													<tr>
														<td>
															<input type="checkbox" class="checkbox" name="burial_id[]" value="{{$item->id}}">
														</td>
														<td>{{$loop->index+1}}</td>
														<td>{{$item->Name}}</td>
														<td>{{$item->Nationalit}}</td>
														<td>{{$item->Country}}</td>
														<td>{{$item->Emirates}}</td>
														<td>{{$item->Sectors_Ar}}</td>
														<td>{{$item->NameAr}}</td>
														<td>{{$item->Hospital}}</td>
														<td>{{$item->Date_Of_De}}</td>
														<td>{{$item->Burial_Dat}}</td>
														<td>{{ $item->Grave_Code }}</td>
														<td>
															<button type="button" class="btn btn-danger btn-sm modal-effect" data-id="{{$item->id}}" data-name="{{$item->Name}}" data-toggle="modal" data-target="#delete" title="{{__('Delete')}}"><i class="fa fa-trash"></i></button>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</form>
								</div>
							</div>
						</div>
						@include('ExcelUpload.modals._delete')
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>

		$('#delete').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var name = button.data('name')
			var modal = $(this)
			modal.find('.modal-body #id').val(id);
			modal.find('.modal-body #name').val(name);
			modal.find('.modal-footer #btn-delete').removeAttr("disabled");
		});

</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/2.0.0/js/select.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.colVis.min.js"></script>






<script>
	new DataTable('#example', {
		"columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
		layout: {
			topStart: {
				buttons: [
					'excel',
					{
						extend: 'colvis',
						columns: ":not(':first,:last')",
					},
					'pageLength'
				],
			}
		},
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, 'All']
		],
	
		language: {
			buttons: {
				colvis: 'hide/show columns',
				pageLength: "Show %d Rows",
			},
			searchPlaceholder: "... Search",
        	search: "",
		},
		select: true,
	});
	table.buttons().container()
		.appendTo('#example_wrapper .col-md-6:eq(0)');
</script>



<script>
	$('#check-all').click(function () {
		if ($(this).is(':checked')) {
			$('.checkbox').prop('checked', true);
		}else{
			$('.checkbox').prop('checked', false);
		}
	})
</script>
@endsection
