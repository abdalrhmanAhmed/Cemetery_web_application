@extends('layouts.master')
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

<script>
    $('select[name=country]').on('change', function(){
        var id = $(this).val();
        if(id)
        {
            $('select[name=city]').empty();
            $.ajax({
                url: "{{url('burials/getCityes')}}/" + id,
                method: "GET",
                success:function(data){
                    $('select[name=city]').append(`<option value="" selected disabled>-- {{ __('Choose City') }} --</option>`)
                    $.each(data, function(key, value){
                        $('select[name=city]').append(`
                            <option value="${key}">${value}</option>
                        `)
                    });
                }
            });
        }
    });

    //get cemetery
    $('select[name=city]').on('change', function(){
        var id = $(this).val();
        if(id)
        {
            $('select[name=cemetery]').empty();
            $.ajax({
                url: "{{url('burials/getCemetery')}}/" + id,
                method: "GET",
                success:function(data){
                    $('select[name=cemetery]').append(`<option value="" selected disabled>-- {{ __('Choose Cemetery') }} --</option>`)
                    $.each(data, function(key, value){
                        $('select[name=cemetery]').append(`
                            <option value="${key}">${value}</option>
                        `)
                    });
                }
            });
        }
    });

    //get blocks
    $('select[name=cemetery]').on('change', function(){
        var id = $(this).val();
        if(id)
        {
            $('select[name=block]').empty();
            $.ajax({
                url: "{{url('burials/getBlocks')}}/" + id,
                method: "GET",
                success:function(data){
                    $('select[name=block]').append(`<option value="" selected disabled>-- {{ __('Choose Block') }} --</option>`)
                    $.each(data, function(key, value){
                        $('select[name=block]').append(`
                            <option value="${key}">${value}</option>
                        `)
                    });
                }
            });
        }
    });
</script>
@endsection