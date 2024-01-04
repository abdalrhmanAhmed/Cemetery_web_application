@extends('layouts.master')
@section('title')
	{{__('Burials')}}
@endsection
@section('css')
@livewireStyles
<link rel="stylesheet" href="{{asset('assets/css/wizard.css')}}">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Burials')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('New Burial') }}</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				@include('notify.notify')
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<livewire:graving.graving/>
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
@livewireScripts
@endsection