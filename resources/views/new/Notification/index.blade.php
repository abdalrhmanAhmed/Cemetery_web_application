@extends('layouts.master')
@section('title')
    {{ __('Notification') }}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
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
                <h4 class="content-title mb-0 my-auto">{{ __('Notification') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('index') }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        {{-- <button class="btn btn-info" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> {{ __("Add New") }}</button> --}}
                        {{-- @include('new.News.modals.add') --}}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('Notification.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md">
                                <div class="col-sm-12 col-md-12 mg-t-10 mg-sm-t-0">
                                    <div class="row mb-4">
                                        <div class="col-md">
                                            <label for="">{{ __('Title In Ar') }} :</label>
                                            <input type="text" class="form-control" name="ar"
                                                placeholder="{{ __('Title In Ar') }}" required />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md">
                                            <label for="">{{ __('Title In En') }} :</label>
                                            <input type="text" class="form-control" name="en"
                                                placeholder="{{ __('Title In En') }}" required />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md">
                                            <label for="">{{ __('Description') }} :</label>
                                            <textarea class="form-control" name="description" required rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="col-sm-12 col-md-12">
                                    <label for="">{{ __('Image') }} :</label>
                                    <input type="file" class="dropify" data-height="400" name="file" accept=".png"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn ripple btn-info" type="submit"><i class="fa fa-plus"></i>
                                {{ __('Add New') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        {{-- <button class="btn btn-info" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> {{ __("Add New") }}</button> --}}
                        {{-- @include('new.News.modals.add') --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">{{ __('Image') }}</th>
                                    <th class="wd-15p border-bottom-0">{{ __('Title') }}</th>
                                    <th class="wd-15p border-bottom-0">{{ __('Description') }}</th>
                                    {{-- <th class="wd-15p border-bottom-0">{{ __('Status') }}</th> --}}
                                    {{-- <th class="wd-15p border-bottom-0">{{ __('Is Loaded') }}</th> --}}
                                    <th class="wd-15p border-bottom-0">{{ __('Oprations') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="main-img-user">
                                                <img alt="avatar" class="rounded-circle"
                                                    src='{{ URL::asset("public/notification-profile/$item->image") }}'
                                                    loading="lazy">
                                            </div>
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{!! Str::limit($item->description, 10, ' ...') !!}</td>
                                        {{-- <td>{{ $item->status }}</td> --}}
                                        {{-- <td class="text-center">
                                            <span
                                                class="badge badge-{{ $item->is_loaded == 0 ? 'danger' : 'success' }} badge-lg">
                                                {{ $item->is_loaded == 0 ? __('No') : __('Yes') }}
                                            </span>
                                        </td> --}}
                                        <td>
                                            <button data-toggle="modal" data-target="#delete{{ $item->id }}"
                                                class="btn btn-danger btn-sm mb-1"> <i class="fa fa-trash"></i>
                                                {{ __('Delete') }}</button>
                                            <a href="{{ route('Notification.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> {{ __('Edit') }}
                                            </a>
                                        </td>
                                    </tr>
                                    @include('new.Notification.modals.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
@section('js')
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
@endsection
