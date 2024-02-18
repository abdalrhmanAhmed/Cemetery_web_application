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
												<th class="wd-15p border-bottom-0">{{ __('Burial Name') }}</th>
												<th class="wd-20p border-bottom-0">{{ __('Nationality Number') }}</th>
												<th class="wd-15p border-bottom-0">{{ __('Age') }}</th>
												<th class="wd-10p border-bottom-0">{{ __('Gender') }}</th>
												<th class="wd-25p border-bottom-0">{{ __('Religion') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Nationality') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Burail Name') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Phone Number') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Address') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('E-mail') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Death Date') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Burial Date') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Hospital') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Cause Of Death') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Cemetry') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Block') }}</th>
                                                <th class="wd-20p border-bottom-0">{{ __('Grave') }}</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($data as $item) 
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>
                                                        @if (app()->getLocale() == 'ar')
                                                            {{$item->first_name_ar . ' ' . $item->second_name_ar . ' ' . $item->third_name_ar . ' ' . $item->fourth_name_ar}}    
                                                        @else
                                                            {{$item->first_name_en . ' ' . $item->second_name_en . ' ' . $item->third_name_en . ' ' . $item->fourth_name_en}}    
                                                        @endif
                                                    </td>
                                                    <td>{{$item->national_number}}</td>
                                                    <td>{{$item->age}}</td>
                                                    <td>{{$item->gender}}</td>
                                                    <td>{{$item->religion}}</td>
                                                    <td>{{$item->nationality}}</td>
                                                    <td>{{$item->burial_name_quadruple}}</td>
                                                    <td>{{$item->phone_number}}</td>
                                                    <td>{{ $item->address }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->dead_date }}</td>
                                                    <td>{{ $item->burial_date }}</td>
                                                    <td>{{ $item->hopital }}</td>
                                                    <td>{{ $item->reason_of_death }}</td>
                                                    <td>{{ $item->cemetry }}</td>
                                                    <td>{{ $item->block }}</td>
                                                    <td>{{ $item->grave }}</td>
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