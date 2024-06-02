@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Excel Uploads')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('Data Review') }}</span>
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
                            <div class="card-body">
                                <div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
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
											</tr>
										</thead>
										<tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$item->name == '' ? __('empty'): $item->name }} </td>
                                                    <td>{{$item->nationality == '' ? __('empty'): $item->nationality }}</td>
                                                    <td>{{$item->country == '' ? __('empty'): $item->country }}</td>
                                                    <td>{{$item->emirates == '' ? __('empty'): $item->emirates }}</td>
                                                    <td>{{$item->sectors_ar == '' ? __('empty'): $item->sectors_ar }}</td>
                                                    <td>{{$item->namear == '' ? __('empty'): $item->namear }}</td>
                                                    <td>{{$item->hospital == '' ? __('empty'): $item->hospital }}</td>
                                                    <td>{{$item->date_of_death == '' ? __('empty'): $item->date_of_death }}</td>
                                                    <td>{{$item->burial_date == '' ? __('empty'): $item->burial_date }}</td>
                                                    <td>{{ $item->grave_code == '' ? __('empty'): $item->grave_code }}</td>
                                                </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
                                <div class="row mt-4">
                                    <div class="col-md-2">
                                        <form action="{{route('uploadExcel.confirm')}}" method="POST">
                                            @csrf
                                            <button class="btn btn-success">{{ __('Confirm Data') }}</button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{route('uploadExcel.cancel')}}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Cancel') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
