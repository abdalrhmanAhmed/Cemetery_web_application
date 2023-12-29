@extends('layouts.master')
@section('css')
@livewireStyles
<link rel="stylesheet" href="{{asset('assets/css/wizard.css')}}">
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
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