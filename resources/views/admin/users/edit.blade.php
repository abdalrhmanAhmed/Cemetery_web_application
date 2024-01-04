@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
{{__('Edit User')}} 
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('Users')}}</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Edit User')}}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{__('Error')}}</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.index') }}">{{__('Back')}}</a>
                    </div>
                </div><br>

                {!! Form::model($user, ['method' => 'PATCH','route' => ['admin.users.update', $user->id]]) !!}
                <div class="">

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>{{__('User Name By Arabic')}}: <span class="tx-danger">*</span></label>
                            <input type="text" class="form-control" name="name_ar" value="{{$user->getTranslation('name', 'ar')}}" id="">
                        </div>
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>{{__('User Name By English')}}: <span class="tx-danger">*</span></label>
                            <input type="text" class="form-control" name="name_en" value="{{$user->getTranslation('name', 'en')}}" id="">
                        </div>
                
                    </div>

                </div>

                <div class="row row-sm mg-b-20">
                    <div class="parsley-input col-md-6" id="lnWrapper">
                        <label>{{__('E-mail')}}: <span class="tx-danger">*</span></label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" id="">
                    </div>
                    <div class="col-lg-6 mg-t-5">
                        <label class="form-label">{{__('Status')}}</label>
                        <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                            <option value="1">{{__('Active')}}</option>
                            <option value="0" {{$user->status == 0 ? 'selected' : ''}}>{{__('Unactive')}}</option>
                        </select>
                    </div>
                </div>

                <div class="row mg-b-20">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{__('Roles')}}</strong>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))
                            !!}
                        </div>
                    </div>
                </div>
                <div class="mg-t-30 d-flex justify-content-center">
                    <button class="btn btn-main-primary pd-x-20" type="submit">{{__('Edit')}}</button>
                </div>
                {!! Form::close() !!}
            </div>
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
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection