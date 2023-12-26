@extends('layouts.master')
@section('css')
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

<style>
	#map{
		width: 500;
		height: 300px;
	}
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المقابر</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مجمعات المقابر</span>
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
								<div class="d-flex justify-content-between">
									<button class="btn btn-primary" data-toggle="modal" data-target="#addBlock"><i class="fa fa-plus"></i> إضافة مجمع جديد</button>
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">إسم المجمع</th>
												<th class="wd-20p border-bottom-0">المقبرة</th>
												<th class="wd-25p border-bottom-0">العمليات</th>

											</tr>
										</thead>
										<tbody>
											@foreach ($blocks as $block)		
												<tr>
													<td>{{$loop->index+1}}</td>
													<td>{{$block->name}}</td>
													<td>{{$block->cemeteries->name}}</td>
													<td>
														<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editBlock{{$block->id}}"><i class="fa fa-edit"></i></button>
														<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBlock{{$block->id}}"><i class="fa fa-trash"></i></button>
													</td>
												</tr>
												@include('blocks.modals.editBlock')
												@include('blocks.modals.deleteBlock')
												
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					@include('blocks.modals.addBlock')
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
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


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuNgarj2Uw4AUIvh6zZOtg30F-Kav-LHE&callback=initMap" async></script>
<script>
	$('select[name=country_id]').on('change', function(){
		id = $(this).val();
		if(id)
		{
			$('select[name=city_id]').empty();
			$.ajax({
				url: "{{url('getCity') }}/"+id,
				method: "GET",
				success:function(data){
					$.each(data,function(key, value){

						$('select[name=city_id]').append(`
							<option value="${value}">${key}</option>
						`);
					})
				} 
			})
			
		}
	});
</script>	
<script>
	let map, activeInfoWindow, markers = [];

	/* ----------------------------- Initialize Map ----------------------------- */
	function initMap() {
		map = new google.maps.Map(document.getElementById("map"), {
			center: {
				lat: 25.1338688,
				lng: 56.3332739,
			},
			zoom: 15
		});

		map.addListener("click", function(event) {
			mapClicked(event);
		});

		initMarkers();
	}


	/* --------------------------- Initialize Markers --------------------------- */
	function initMarkers() {
		const initialMarkers = <?php echo json_encode($initialMarkers); ?>;

		for (let index = 0; index < initialMarkers.length; index++) {

			const markerData = initialMarkers[index];
			const marker = new google.maps.Marker({
				position: markerData.position,
				label: markerData.label,
				draggable: markerData.draggable,
				map
			});
			markers.push(marker);

			const infowindow = new google.maps.InfoWindow({
				content: `<b>${markerData.position.lat}, ${markerData.position.lng}</b>`,
			});
			marker.addListener("click", (event) => {
				if(activeInfoWindow) {
					activeInfoWindow.close();
				}
				infowindow.open({
					anchor: marker,
					shouldFocus: false,
					map
				});
				activeInfoWindow = infowindow;
				markerClicked(marker, index);
			});

			marker.addListener("dragend", (event) => {
				markerDragEnd(event, index);
			});
		}
	}

	/* ------------------------- Handle Map Click Event ------------------------- */
	function mapClicked(event) {
		console.log(map);
		console.log(event.latLng.lat(), event.latLng.lng());
	}

	/* ------------------------ Handle Marker Click Event ----------------------- */
	function markerClicked(marker, index) {
		console.log(map);
		console.log(marker.position.lat());
		console.log(marker.position.lng());
	}

	/* ----------------------- Handle Marker DragEnd Event ---------------------- */
	function markerDragEnd(event, index) {
		console.log(map);
		console.log(event.latLng.lat());
		console.log(event.latLng.lng());
		$('input[name=latitude]').empty();
		$('input[name=longitude]').empty();
		$('input[name=latitude]').val(event.latLng.lat()) 
		$('input[name=longitude]').val(event.latLng.lng()) 
	}
</script>



@endsection