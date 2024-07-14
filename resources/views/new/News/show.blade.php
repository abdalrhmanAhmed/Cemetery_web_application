@extends('layouts.master')
@section('title')
    {{ __('Show') }}
@stop
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('News') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $libary->name ?? '' }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" data-toggle="modal" data-target="#text" class="btn btn-primary btn-icon ml-2"><i
                        class="mdi mdi-file"></i></button>
                @include('new.News.modals.text')
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" data-toggle="modal" data-target="#upload" class="btn btn-warning btn-icon ml-2"><i
                        class="mdi mdi-upload"></i></button>
                @include('new.News.modals.upload')
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a type="button" href="{{ route('NewsController.index') }}" class="btn btn-info btn-icon ml-2"
                    style="color: #fff"><i class="mdi mdi-arrow-left"></i></a>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">{{ __('Name In Ar') }}</label>
                            <input type="text" class="form-control" name="ar"
                                value="{{ $libary->getTranslation('name', 'ar') }}" readonly />
                        </div>
                        <div class="col-md">
                            <label for="">{{ __('Name In En') }}</label>
                            <input type="text" class="form-control" name="en"
                                value="{{ $libary->getTranslation('name', 'en') }}" readonly />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <img alt="user-img" class="avatar avatar-xl brround mCS_img_loaded"
                                src='{{ URL::asset("public/News-profile/$libary->image") }}' loading="lazy">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">{{ __('Video') }}</label>
                                    <h3>{{ App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 1)->count() }}
                                    </h3>
                                </div>
                                <div class="col-md-3">
                                    <label for="">{{ __('Voice') }}</label>
                                    <h3>{{ App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 3)->count() }}
                                    </h3>
                                </div>
                                <div class="col-md-3">
                                    <label for="">{{ __('Image') }}</label>
                                    <h3>{{ App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 2)->count() }}
                                    </h3>
                                </div>
                                <div class="col-md-3">
                                    <label for="">{{ __('Text') }}</label>
                                    <h3>{{ App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 0)->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row -->
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h5>{{ __('Video') }}</h5>
                            <br>
                            <div class="row">
                                @foreach (App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 1)->get() as $item)
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-title">
                                                    <a href="{{ route('NewsDetailsController.delete', $item->id) }}"
                                                        class="btn btn-danger btn-block">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <video width="320" height="240" controls>
                                                        <source src='{{ URL::asset("public/News-details/$item->value") }}'
                                                            type="video/mp4">
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>{{ __('Voice') }}</h5>
                            <br>
                            <div class="row">
                                @foreach (App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 3)->get() as $item)
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <a href="{{ route('NewsDetailsController.delete', $item->id) }}"
                                                    class="btn btn-danger btn-block">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <audio controls style="width: 100%">
                                                    <source src='{{ URL::asset("public/News-details/$item->value") }}'
                                                        type="audio/ogg">
                                                </audio>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>{{ __('image') }}</h5>
                            <br>
                            <div class="row">
                                @foreach (App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 2)->get() as $item)
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <a href="{{ route('NewsDetailsController.delete', $item->id) }}"
                                                    class="btn btn-danger btn-block">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img src='{{ URL::asset("public/News-details/$item->value") }}'
                                                    loading="lazy" width="300" height="300">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>{{ __('Text') }}</h5>
                            <br>
                            <div class="row">
                                @foreach (App\Models\NewsDetails::where('news_id', $libary->id)->where('type', 0)->get() as $item)
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <a href="{{ route('NewsDetailsController.delete', $item->id) }}"
                                                    class="btn btn-danger btn-block">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <textarea name="text" class="form-control ckeditor" required rows="10" readonly>
																{!! $item->value !!}
															</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row clodes-->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!-- Internal TelephoneInput js-->
    <script src="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js') }}"></script>




    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    {{-- <script src="https://cdn.ckbox.io/ckbox/2.3.1/ckbox.js"></script> --}}
    <script src="{{ URL::asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.config.language = "{{ app()->getLocale() }}"
    </script>
@endsection
