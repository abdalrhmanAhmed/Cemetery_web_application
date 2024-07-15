@extends('layouts.master')
@section('title')
    {{ __('Settings') }}
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('Settings') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('index') }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    {{-- start Google Maps --}}
    <!-- row -->
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Google Maps Settinges') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('Setting.store_google') }}" method="post" class="form-group">
                        @csrf
                        <label for="">{{ __('Google Maps Key') }}</label>
                        <input type="text" class="form-control" name="google_key"
                            placeholder="{{ __('Google Maps Key') }}"
                            value="{{ App\Models\Setting::where('key', 'google_key')->first()->value ?? '' }}" required>
                        <div class="form-text text-muted mb-4">
                            {{ __('Insert google maps key') }} ( <a
                                href="https://console.developers.google.com/apis/dashboard">https://console.developers.google.com/apis/dashboard</a>
                            )
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                            {{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    {{-- end Google Maps --}}



    {{-- start Android Route --}}
    <!-- row -->
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Google Play Url') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('Setting.store_android') }}" method="post" class="form-group">
                        @csrf
                        <label for="">{{ __('Android Url') }}</label>
                        <input type="text" class="form-control" name="android_url" placeholder="{{ __('Android Url') }}"
                            value="{{ App\Models\Setting::where('key', 'android_url')->first()->value ?? '' }}" required>
                        <br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                            {{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    {{-- end Android Route --}}



    {{-- start Ios Route --}}
    <!-- row -->
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('App Store Url') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('Setting.store_ios') }}" method="post" class="form-group">
                        @csrf
                        <label for="">{{ __('Ios Url') }}</label>
                        <input type="text" class="form-control" name="ios_url" placeholder="{{ __('Ios Url') }}"
                            value="{{ App\Models\Setting::where('key', 'ios_url')->first()->value ?? '' }}" required>
                        <br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                            {{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    {{-- end Ios Route --}}





    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
