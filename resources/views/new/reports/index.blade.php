@extends('layouts.master')
@section('title')
    {{ __('Reports') }}
@stop
@section('css')
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('Reports') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('Reports') }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">{{ __('Reports') }}</h6>
                        <p class="text-muted card-sub-title">{{ __('This is a set of reports about the system') }}.</p>
                    </div>
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                    data-toggle="tab">{{ __('Monthly death statistics for the year:') }}</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link"
                                                    data-toggle="tab">{{ __('Statistics comparing deaths for two years:') }}</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link"
                                                    data-toggle="tab">{{ __('Death statistics by nationalities:') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <h5>{{ __('Death statistics for the year') }} {{ $year }}
                                            </h5>
                                            <br>
                                            <form action="{{ route('Report.filtter') }}" method="get" class="mb-10">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <select name="year" id="year" class="form-control"
                                                            style="height: auto">
                                                            @for ($i = date_format(now(), 'Y'); $i >= 1900; $i--)
                                                                <option value="{{ $i }}"
                                                                    {{ $year == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" value=""
                                                            class="btn btn-success btn-md">
                                                            <i class="fa fa-search"></i>
                                                            {{ __('Search') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table text-md-nowrap" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('year') }} {{ $year }}</th>
                                                            <th>{{ __('citizen') }}</th>
                                                            <th>{{ __('The fall') }}</th>
                                                            <th>{{ __('Non-citizen') }}</th>
                                                            <th>{{ __('The fall') }}</th>
                                                            <th>{{ __('Amputated part') }}</th>
                                                            <th>{{ __('unknown') }}</th>
                                                            <th>{{ __('the total') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                                $A = 0;
                                                                $B = 0;
                                                                $C = 0;
                                                                $D = 0;
                                                                $E = 0;
                                                                $F = 0;
                                                            @endphp
                                                            <td>{{ __('January') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 1 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $A += $burial_excels;
                                                            @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 1 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $B += $burial_excels;
                                                            @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 1 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $C += $burial_excels;
                                                            @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 1 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $D += $burial_excels;
                                                            @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 1 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $E += $burial_excels;
                                                            @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 1 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('February') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 2 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 2 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 2 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 2 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 2 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 2 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('March') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 3 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 3 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 3 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 3 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 3 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 3 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('April') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 4 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 4 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 4 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 4 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 4 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 4 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('May') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 5 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 5 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 5 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 5 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 5 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 5 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('June') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 6 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 6 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 6 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 6 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 6 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 6 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('July') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 7 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 7 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 7 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 7 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 7 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 7 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('August') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 8 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 8 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 8 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 8 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 8 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 8 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('September') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 9 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 9 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 9 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 9 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 9 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 9 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('October') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 10 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 10 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 10 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 10 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 10 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 10 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('November') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 11 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 11 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 11 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 11 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 11 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 11 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                                $a = 0;
                                                            @endphp
                                                            <td>{{ __('December') }}</td>
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 12 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $A += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 12 . '%')->where('nationality', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $B += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 12 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', '!=', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $C += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 12 . '%')->where('nationality', '!=', 'الإمارات')->where('cause_of_death', 'سقط')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $D += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 12 . '%')->where('cause_of_death', 'جزء مبتور')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                            $E += $burial_excels; @endphp
                                                            <td>{{ $burial_excels = App\Models\BurialExcel::select('id')->where('date_of_death', 'like', $year . '-' . 12 . '%')->where('nationality', '!=', 'مجهول')->count() }}
                                                            </td>
                                                            @php
                                                                $a += $burial_excels;
                                                                $F += $burial_excels;
                                                            @endphp
                                                            <td>{{ $a }}</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot class="text-center">
                                                        <tr>
                                                            <td rowspan="2" style="text-align: center;">
                                                                {{ __('the total') }}</td>
                                                            <td>@php
                                                                echo $A;
                                                            @endphp</td>
                                                            <td>@php
                                                                echo $B;
                                                            @endphp</td>
                                                            <td>@php
                                                                echo $C;
                                                            @endphp</td>
                                                            <td>@php
                                                                echo $D;
                                                            @endphp</td>
                                                            <td>@php
                                                                echo $E;
                                                            @endphp</td>
                                                            <td>@php
                                                                echo $F;
                                                            @endphp</td>
                                                            <td rowspan="2" style="text-align: center;">
                                                                @php
                                                                    echo $A + $B + $C + $D + $E + $F;
                                                                @endphp</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-center"
                                                                style="background-color: #555;color:#fff;border: 1px solid #fff">
                                                                @php echo $A + $B; @endphp</td>
                                                            <td colspan="2" class="text-center"
                                                                style="background-color: #555;color:#fff;border: 1px solid #fff">
                                                                @php echo $C + $D; @endphp</td>
                                                            <td colspan="2" class="text-center"
                                                                style="background-color: #555;color:#fff;border: 1px solid #fff">
                                                                @php echo $E + $F; @endphp</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>



                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h5>{{ __('Death statistics for the year') }} {{ $year }}
                                                || {{ $year2 }}
                                            </h5>
                                            <br>
                                            <form action="{{ route('Report.filtter') }}" method="get" class="mb-10">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="">{{ __('From') }}</label>
                                                        <select name="year" id="year" class="form-control"
                                                            style="height: auto">
                                                            @for ($i = date_format(now(), 'Y'); $i >= 1900; $i--)
                                                                <option value="{{ $i }}"
                                                                    {{ $year == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="">{{ __('To') }}</label>
                                                        <select name="year2" id="year" class="form-control"
                                                            style="height: auto">
                                                            @for ($i = date_format(now(), 'Y'); $i >= 1900; $i--)
                                                                <option value="{{ $i }}"
                                                                    {{ $year2 == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" value=""
                                                            class="btn btn-success btn-md">
                                                            <i class="fa fa-search"></i>
                                                            {{ __('Search') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table text-md-nowrap" id="example1">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>{{ __('Statement') }}</th>
                                                            <th>{{ __('Deaths during the year') }} : {{ $year }}
                                                            </th>
                                                            <th>{{ __('Deaths during the year') }} : {{ $year2 }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @php
                                                            $startDate = \Carbon\Carbon::parse(
                                                                $year . '-01-01',
                                                            )->startOfDay();
                                                            $endDate = \Carbon\Carbon::parse(
                                                                $year2 . '-12-31',
                                                            )->endOfDay();

                                                            $burial_excels = App\Models\BurialExcel::select(
                                                                'sectors_ar',
                                                            )
                                                                ->distinct('sectors_ar')
                                                                ->whereBetween('date_of_death', [$startDate, $endDate])
                                                                ->get();
                                                            $dath_row = 0;
                                                            $dath_total = 0;
                                                            $dath_fall_row = 0;
                                                            $dthe_fall_total = 0;
                                                        @endphp
                                                        @foreach ($burial_excels as $burial_excel)
                                                            @php
                                                                $dath_row = App\Models\BurialExcel::select('sectors_ar')
                                                                    ->where(
                                                                        'sectors_ar',
                                                                        'like',
                                                                        '%' . $burial_excel->sectors_ar . '%',
                                                                    )
                                                                    ->where('date_of_death', 'like', '%' . $year . '%')
                                                                    ->count();
                                                                $dath_total += $dath_row;
                                                                $dath_fall_row = App\Models\BurialExcel::select(
                                                                    'sectors_ar',
                                                                )
                                                                    ->where(
                                                                        'sectors_ar',
                                                                        'like',
                                                                        '%' . $burial_excel->sectors_ar . '%',
                                                                    )
                                                                    ->where('date_of_death', 'like', '%' . $year2 . '%')
                                                                    ->count();
                                                                $dthe_fall_total += $dath_fall_row;
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $burial_excel->sectors_ar }}</td>
                                                                <td>{{ $dath_row }}
                                                                </td>
                                                                <td>{{ $dath_fall_row }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="text-center">
                                                        <tr>
                                                            <td>
                                                                {{ __('the total') }}</td>
                                                            <td>{{ $dath_total }}</td>
                                                            <td>{{ $dthe_fall_total }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <h5>{{ __('Death statistics for the year') }} {{ $year }}
                                            </h5>
                                            <br>
                                            <form action="{{ route('Report.filtter') }}" method="get" class="mb-10">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <select name="year" id="year" class="form-control"
                                                            style="height: auto">
                                                            @for ($i = date_format(now(), 'Y'); $i >= 1900; $i--)
                                                                <option value="{{ $i }}"
                                                                    {{ $year == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" value=""
                                                            class="btn btn-success btn-md">
                                                            <i class="fa fa-search"></i>
                                                            {{ __('Search') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table text-md-nowrap" id="example1">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>{{ __('Nationality') }}</th>
                                                            <th>{{ __('Death') }}</th>
                                                            <th>{{ __('The fall') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @php

                                                            $burial_excels = App\Models\BurialExcel::select(
                                                                'nationality',
                                                            )
                                                                ->distinct('nationality')
                                                                ->where('date_of_death', 'like', '%' . $year . '%')
                                                                ->get();
                                                            $dath_row = 0;
                                                            $dath_total = 0;
                                                            $dath_fall_row = 0;
                                                            $dthe_fall_total = 0;
                                                        @endphp
                                                        @foreach ($burial_excels as $burial_excel)
                                                            @php
                                                                $dath_row = App\Models\BurialExcel::select(
                                                                    'nationality',
                                                                )
                                                                    ->where(
                                                                        'nationality',
                                                                        'like',
                                                                        '%' . $burial_excel->nationality . '%',
                                                                    )
                                                                    ->where('date_of_death', 'like', '%' . $year . '%')
                                                                    ->where('cause_of_death', '!=', 'سقط')
                                                                    ->count();
                                                                $dath_total += $dath_row;
                                                                $dath_fall_row = App\Models\BurialExcel::select(
                                                                    'nationality',
                                                                )
                                                                    ->where(
                                                                        'nationality',
                                                                        'like',
                                                                        '%' . $burial_excel->nationality . '%',
                                                                    )
                                                                    ->where('date_of_death', 'like', '%' . $year . '%')
                                                                    ->where('cause_of_death', 'سقط')
                                                                    ->count();
                                                                $dthe_fall_total += $dath_fall_row;
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $burial_excel->nationality }}</td>
                                                                <td>{{ $dath_row }}
                                                                </td>
                                                                <td>{{ $dath_fall_row }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="text-center">
                                                        <tr>
                                                            <td>
                                                                {{ __('the total') }}</td>
                                                            <td>{{ $dath_total }}</td>
                                                            <td>{{ $dthe_fall_total }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endsection
