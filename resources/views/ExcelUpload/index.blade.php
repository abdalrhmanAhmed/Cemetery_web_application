@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('Burials') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Upload Excel file')}}</span>
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
                                @if(\App\Models\ExcelTemperary::get()->count() > 0)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <a href="{{route('uploadExcel.review')}}" class="btn btn-success">{{ __('Data Review') }}</a>
                                        </div>
                                    </div>
                                @endif
                                <form action="{{route('uploadExcel.upload')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="file[]" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" multiple>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-success">{{ __('Upload File') }}</button>
                                        </div>
                                    </div>
                                </form>
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
@endsection