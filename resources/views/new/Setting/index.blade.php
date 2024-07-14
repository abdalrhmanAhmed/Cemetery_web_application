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


    {{-- start Push Notifications --}}
    <!-- row -->
    {{-- <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Push Notifications Settinges') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('Setting.store_push_notification') }}" method="post" class="form-group">
                        @csrf
                        <div class="row">
                            <div class="col-md">
                                <label for="">{{ __('Firebase Cloud Messaging Key') }}</label>
                                <input type="text" class="form-control" name="firebase_cloud_messaging_key"
                                    placeholder="{{ __('Firebase Cloud Messaging Key') }}"
                                    value="{{ App\Models\Setting::where('key', 'firebase_cloud_messaging_key')->first()->value ?? '' }}"
                                    required>
                                <div class="form-text text-muted mb-4">
                                    {{ __('insert Firebase Cloud Messaging Key') }} ( <a
                                        href="https://console.firebase.google.com/">https://console.firebase.google.com</a>
                                    )
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md">
                                <label for="">{{ __('API Key') }}</label>
                                <input type="text" class="form-control" name="api_key" placeholder="{{ __('API Key') }}"
                                    value="{{ App\Models\Setting::where('key', 'api_key')->first()->value ?? '' }}"
                                    required>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Auth Domain') }}</label>
                                <input type="text" class="form-control" name="auth_domain"
                                    placeholder="{{ __('Auth Domain') }}"
                                    value="{{ App\Models\Setting::where('key', 'auth_domain')->first()->value ?? '' }}"
                                    required>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Database URL') }}</label>
                                <input type="text" class="form-control" name="database_url"
                                    placeholder="{{ __('Database URL') }}"
                                    value="{{ App\Models\Setting::where('key', 'database_url')->first()->value ?? '' }}"
                                    required>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Project ID') }}</label>
                                <input type="text" class="form-control" name="project_iD"
                                    placeholder="{{ __('Project ID') }}"
                                    value="{{ App\Models\Setting::where('key', 'project_iD')->first()->value ?? '' }}"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md">
                                <label for="">{{ __('Storage Bucket') }}</label>
                                <input type="text" class="form-control" name="storage_bucket"
                                    placeholder="{{ __('Storage Bucket') }}"
                                    value="{{ App\Models\Setting::where('key', 'storage_bucket')->first()->value ?? '' }}"
                                    required>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Messaging Sender Id') }}</label>
                                <input type="text" class="form-control" name="messaging_sender_id"
                                    placeholder="{{ __('Messaging Sender Id') }}"
                                    value="{{ App\Models\Setting::where('key', 'messaging_sender_id')->first()->value ?? '' }}"
                                    required>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Application ID') }}</label>
                                <input type="text" class="form-control" name="application_id"
                                    placeholder="{{ __('Application ID') }}"
                                    value="{{ App\Models\Setting::where('key', 'application_id')->first()->value ?? '' }}"
                                    required>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Measurement Id') }}</label>
                                <input type="text" class="form-control" name="measurement_id"
                                    placeholder="{{ __('Measurement Id') }}"
                                    value="{{ App\Models\Setting::where('key', 'measurement_id')->first()->value ?? '' }}"
                                    required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                            {{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- row closed -->
    {{-- end Push Notifications --}}


    {{-- start Mail Host --}}
    <!-- row -->
    {{-- <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Mail Host Settinges') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('Setting.store_mail') }}" method="post" class="form-group">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md">
                                <label for="">{{ __('Mail Host') }}</label>
                                <input type="text" class="form-control" name="mail_host"
                                    placeholder="{{ __('Mail Host') }}"
                                    value="{{ App\Models\Setting::where('key', 'mail_host')->first()->value ?? '' }}"
                                    required>
                                <div class="form-text text-muted">
                                    {{ __('Insert the mail host address') }}
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Mail Port') }}</label>
                                <input type="text" class="form-control" name="mail_port"
                                    placeholder="{{ __('Mail Port') }}"
                                    value="{{ App\Models\Setting::where('key', 'mail_port')->first()->value ?? '' }}"
                                    required>
                                <div class="form-text text-muted">
                                    {{ __('Insert the mail port') }}
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Mail encryption') }}</label>
                                <select class="form-control" name="mail_encryption"
                                    placeholder="{{ __('Mail encryption') }}" required>
                                    <option
                                        {{ App\Models\Setting::where('key', 'mail_encryption')->first()->value ?? '' == 'ssl' ? 'selected' : '' }}
                                        value="ssl" selected>SSL</option>
                                    <option
                                        {{ App\Models\Setting::where('key', 'mail_encryption')->first()->value ?? '' == 'tls' ? 'selected' : '' }}
                                        value="tls">TLS</option>
                                </select>
                                <div class="form-text text-muted">
                                    {{ __('Select the mail encryption TLS / SSL') }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md">
                                <label for="">{{ __('Username') }}</label>
                                <input type="text" class="form-control" name="username"
                                    placeholder="{{ __('Username') }}"
                                    value="{{ App\Models\Setting::where('key', 'username')->first()->value ?? '' }}"
                                    required>
                                <div class="form-text text-muted">
                                    {{ __('Insert the mail username most of services use email as username') }}
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Mail Password') }}</label>
                                <input type="password" class="form-control" name="mail_password"
                                    placeholder="{{ __('Mail Password') }}"
                                    value="{{ App\Models\Setting::where('key', 'mail_password')->first()->value ?? '' }}"
                                    required>
                                <div class="form-text text-muted">
                                    {{ __('Insert the mail password') }}
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Sender Email') }}</label>
                                <input type="text" class="form-control" name="sender_email"
                                    placeholder="{{ __('Sender Email') }}"
                                    value="{{ App\Models\Setting::where('key', 'sender_email')->first()->value ?? '' }}"
                                    required>
                                <div class="form-text text-muted">
                                    {{ __('Insert the sender email address') }}
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="">{{ __('Sender Name') }}</label>
                                <input type="text" class="form-control" name="sender_name"
                                    placeholder="{{ __('Sender Name') }}"
                                    value="{{ App\Models\Setting::where('key', 'sender_name')->first()->value ?? '' }}"
                                    required>
                                <div class="form-text text-muted">
                                    {{ __('Insert the sender Name') }}
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                            {{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- row closed -->
    {{-- end Mail Host --}}



    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
