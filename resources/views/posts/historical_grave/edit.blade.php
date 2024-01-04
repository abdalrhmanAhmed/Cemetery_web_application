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
							<h4 class="content-title mb-0 my-auto">قبور تاريخية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الإعدادات </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">تعديل قبر تاريخي</h4>
									<a class="btn btn-info btn-sm" href="{{route('historical_grave.index')}}"><i class="fa fa-arrow-left"></i></a>
								</div>
							</div>
							<div class="card-body">
                                <form action="{{route('historical_grave.store')}}" method="POST">
                                    @csrf                                    
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="location">العنوان</label>
                                            <input name="title" placeholder="عنوان القبر" class="form-control" type="text" value="{{$historical_grave->title}}" required>
                                            </input>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="name_ar"> إسم صاحب القبر التاريخي عربي</label>
                                            <input type="text" name="name_ar" placeholder="إسم صاحب القبر التاريخي" class="form-control" value="{{$historical_grave->name}}" required>
                                        </div>
                                        <div class="col-md">
                                            <label for="name_en"> إسم صاحب القبر التاريخي إنجليزي</label>
                                            <input type="text" name="name_en" placeholder="إسم صاحب القبر التاريخي" class="form-control" value="{{$historical_grave->name}}" required>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="name_ar">نبذة عن صاحل القبر التاريخي</label>
                                            <textarea name="text" class="form-control ckeditor" cols="30" rows="10">{{$historical_grave->text}}</textarea>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="map-container" style="margin: 2px;">
                                        <div class="row map-input-fields">
                                            <div class="col-md">
                                                <div class="form-group row">
                                                    <div class="col-md map-input-with-no-padding">
                                                        <label for=""> {{__('Latitude')}}</label>
                                                        <input class="form-control" readonly value="{{$historical_grave->latitude}}" name="latitude" type="text" required><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group row">
                                                    <div class="col-md map-input-with-no-padding">
                                                        <label for="">{{__('Longitude')}}</label>
                                                        <input class="form-control" readonly value="{{$historical_grave->Longitude}}"  name="longitude" type="text" required><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="map"></div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn ripple btn-info" type="submit"><i class="fa fa-plus"></i> إضافة</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                    </div>
                                </form>
							</div>
						</div>
					</div>	
					<!--/div-->

				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection 
@section('content')
				<!-- row -->
				<div class="row">

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


<script src="{{URL::asset('assets/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
	CKEDITOR.config.language = "{{app()->getLocale()}}"
</script>
@endsection