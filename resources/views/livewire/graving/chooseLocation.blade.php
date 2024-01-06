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
							<h4 class="content-title mb-0 my-auto">{{ __('Burials') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $edit == 1 ? __('Edit Burial') : __('Add Burial') }}</span>
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
								<form action="{{route('setpLocaltion.storeLocation', $grave->id)}}" method="POST">
									@csrf
									<div class="row mb-3">
										<div class="col-md-4">
											<label for="">{{ __('Burial Name') }}</label>
											<input type="text" class="form-control" readonly value="{{$information->deceased->name}} {{ $information->deceased->father }} {{ $information->deceased->grand_father }} {{  $information->deceased->great_grand_father }}" id="">
										</div>
										<div class="col-md-4">
											<label for="">{{ __('Block') }}</label>
											<input type="text" class="form-control" readonly value="{{$grave->blocks->name}}" id="">
										</div>
										<div class="col-md-4">
											<label for="">{{ __('Grave') }}</label>
											<input type="text" class="form-control" readonly value="{{ $grave->name }}" id="">
											<input type="hidden" value="{{$edit}}" name="editMode">
										</div>
									</div>
									<div class="map-container" style="margin: 2px;">
										<div class="row map-input-fields">
											<div class="col-md">
												<div class="form-group row">
													<div class="col-md map-input-with-no-padding">
														<label for=""> {{__('Latitude')}}</label>
														<input class="form-control" readonly name="latitude"
														value="{{ $edit == 1 ? $grave->latitude : '' }}" type="text"><br>
													</div>
												</div>
											</div>
											<div class="col-md">
												<div class="form-group row">
													<div class="col-md map-input-with-no-padding">
														<label for="">{{__('Longitude')}}</label>
														<input class="form-control" readonly  name="longitude"
														value="{{ $edit == 1 ? $grave->Longitude : '' }}" type="text"><br>
													</div>
												</div>
											</div>
										</div>
										<div id="map"></div>
									</div>
									<div class="row mt-4">
										<div class="col-md-12 d-flex justify-content-center">
											<button type="submit" class="btn btn-primary">{{__("Save")}}</button>
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
	let map, activeInfoWindow, markers = [];

	/* ----------------------------- Initialize Map ----------------------------- */
	function initMap() {
		map = new google.maps.Map(document.getElementById("map"), {
			center: {
				lat: {{$latitude}},
				lng: {{$longitude}},
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