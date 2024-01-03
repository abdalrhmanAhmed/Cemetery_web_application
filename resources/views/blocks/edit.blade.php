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
							<h4 class="content-title mb-0 my-auto">{{__('Blocks')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{route('blocks.index')}}">{{__('Edit Block')}}</a></span>
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
                                <form action="{{route('blocks.update', $block->id)}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="">{{__('Block Name By Arabic')}}</label>
                                                <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{$block->getTranslation('name', 'ar')}}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">{{__('Block Name By English')}}</label>
                                                <input type="text" class="form-control" name="name_en" id="name_en" value="{{$block->getTranslation('name', 'en')}}"  required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="">{{__('Cemetery')}}</label>
                                                <select name="cemetery" class="form-control" id="">
                                                    <option value="" selected disabled>--{{__('Choose Cemetery')}}--</option>
                                                    @foreach ($cemeteries as $cemetery)
                                                        <option value="{{$cemetery->id}}" {{$block->cemetery_id == $cemetery->id ? 'selected' : ''}}>{{ $cemetery->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">{{__('Graves Count')}}</label>
                                                <input type="number" class="form-control" name="grave_count" value="{{$block->graves->count()}}" id="">
                                            </div>
                                        </div>
                                        <div class="map-container" style="margin: 2px;">
                                            <div class="row map-input-fields">
                                                <div class="col-md">
                                                    <div class="form-group row">
                                                        <div class="col-md map-input-with-no-padding">
                                                            <label for=""> {{__('Latitude')}}</label>
                                                            <input class="form-control" readonly name="latitude" value="{{$block->latitude}}" type="text"><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group row">
                                                        <div class="col-md map-input-with-no-padding">
                                                            <label for="">{{__('Longitude')}}</label>
                                                            <input class="form-control" readonly  name="longitude" value="{{$block->Longitude}}" type="text"><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
										<div class="row">
											<div class="col-md-12 d-flex justify-content-center">
												<button class="btn btn-primary" type="submit">{{__('Edit')}}</button>
											</div>
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