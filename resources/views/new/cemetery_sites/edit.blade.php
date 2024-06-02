@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!---Internal Fancy uploader css-->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
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
							<h4 class="content-title mb-0 my-auto">{{ __('Cemetery Sites') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('Edit') }}</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<a type="button" href="{{ route('cemetery-site.index') }}" class="btn btn-info btn-icon ml-2" style="color: #fff"><i class="mdi mdi-arrow-left"></i></a>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('cemetery-site.update', $cemetery_sites->id) }}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-md">
                                            <label for="">{{ __('Name In Ar') }}</label>
                                            <input type="text" class="form-control" name="ar" value="{{ $cemetery_sites->getTranslation('name', 'ar')}}" required/>
                                        </div>
                                        <div class="col-md">
                                            <label for="">{{ __('Name In En') }}</label>
                                            <input type="text" class="form-control" name="en" value="{{ $cemetery_sites->getTranslation('name', 'en')}}"  required/>
                                        </div>
                                    </div>
									<div class="col-md">
										<label for="">{{ __('Text') }}</label>
										<textarea name="text" id="" cols="30" rows="10" class="form-control ckeditor">{{ $cemetery_sites->text }}</textarea>
									</div>
								</div>
                                    <div class="row">
                                        <div class="col-md">
											<label for="">{{ __("Image") }} : </label>
                                            <input type="file" name="image" class="dropify" data-height="200"  accept=".png"/>
                                        </div>
                                        <div class="col-md text-center">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <img  src='{{ URL::asset("public/cemetery_sites-profile/$cemetery_sites->image")  }}' loading="lazy"  alt="{{ $cemetery_sites->name }}" width="170" height="170">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md">
                                            <div class="map-container" style="margin: 2px;">
                                                <div class="row map-input-fields">
                                                    <div class="col-md">
                                                        <div class="form-group row">
                                                            <div class="col-md map-input-with-no-padding">
                                                                <label for=""> {{__('Latitude')}}</label>
                                                                <input class="form-control" readonly name="latitude" type="text" value="{{  $cemetery_sites->latitude }}"><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="form-group row">
                                                            <div class="col-md map-input-with-no-padding">
                                                                <label for="">{{__('Longitude')}}</label>
                                                                <input class="form-control" readonly  name="longitude" type="text" value="{{  $cemetery_sites->longitude }}"><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="map"></div>
                                            </div>                      
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">{{ __('Edit') }}</button>
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
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>


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
	let zoomNum = 13;
	let latNum = {{ intval($cemetery_sites->latitude) }};
	let lngNum = {{ intval($cemetery_sites->longitude) }};

	/* ----------------------------- Initialize Map ----------------------------- */
	function initMap() {
		map = new google.maps.Map(document.getElementById("map"), {
			center: {
				lat: latNum,
				lng: lngNum,
			},
			zoom: zoomNum,
			mapTypeId: 'roadmap'
		});

		map.addListener("click", function(event) {
			mapClicked(event);
		});

		initMarkers();
	}


	/* --------------------------- Initialize Markers --------------------------- */
	function initMarkers() {
		const initialMarkers = @php echo json_encode($initialMarkers) @endphp;

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