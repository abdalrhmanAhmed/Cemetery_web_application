@extends('layouts.master')
@section('css')
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
							<h4 class="content-title mb-0 my-auto">{{__('Cemeteries')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{route('cemetery.index')}}">{{__('Edit Cemetery')}}</a></span>
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
								<form action="{{route('cemetery.update', $cemeterie->id)}}" method="POST">
									@csrf
									@method('PUT')
									<div class="row mb-3">
										<div class="col-md-6">
											<label for="">{{__('Cemetery Name By Arabic')}}</label>
											<input type="text" name="name_ar" value="{{$cemeterie->getTranslation('name', 'ar')}}" placeholder="{{__('Cemetery Name By Arabic')}}" class="form-control" required>
										</div>
										<div class="col-md-6">
											<label for="">{{__('Cemetery Name By English')}}</label>
											<input type="text" name="name_en" value="{{$cemeterie->getTranslation('name', 'en')}}" placeholder="{{__('Cemetery Name By English')}}" class="form-control" required>
										</div>
									</div>
								
									<div class="row">
										@php
											$cities = App\Models\City::where('country_id', $cemeterie->cities->country_id)->first();
										@endphp
										<div class="col-md-6">
											<label for="">{{__('Countery')}}</label>
											<select name="country_id" class="form-control" required>
												@foreach ($countries as $country)
													<option value="{{$country->id}}" {{$country->id == $cemeterie->cities->country_id ? 'selected' : ''}}>{{$country->name}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-6">
											<label for="">{{__('City')}}</label>
											<select name="city_id" class="form-control" required>
												<option value="{{$cities->id}}">{{$cities->name}}</option>
											</select>
										</div>
									</div>
									<br>
									<div class="map-container" style="margin: 2px;">
										<div class="row map-input-fields">
											<div class="col-md">
												<div class="form-group row">
													<div class="col-md map-input-with-no-padding">
														<label> {{__('Latitude')}}</label>
														<input class="form-control" value="{{$cemeterie->latitude}}" readonly  name="latitude" type="text"><br>
													</div>
												</div>
											</div>
											<div class="col-md">
												<div class="form-group row">
													<div class="col-md map-input-with-no-padding">
														<label>{{__('Longitude')}}</label>
														<input class="form-control" value="{{$cemeterie->Longitude}}" readonly  name="longitude" type="text"><br>
													</div>
												</div>
											</div>
										</div>
										<div id="map"></div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12 d-flex justify-content-end">
											<button class="btn ripple btn-warning" type="submit"><i class="fa fa-edit"></i> {{__('Edit')}}</button>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL__x5g-TIhqIoQQazJzEbHZQWKXReeF8&callback=initMap" async></script>
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
							<option value="${key}">${value}</option>
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
				lat: <?php echo json_encode(floatval($cemeterie->latitude)); ?>,
				lng: <?php echo json_encode(floatval($cemeterie->Longitude)); ?>,
			},
			zoom: 15,
			mapTypeId: 'satellite'
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