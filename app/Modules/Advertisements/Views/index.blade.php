@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('advertisements.index') }}">{{ module_lang('Advertisements', 'breadcrumb.advertisements') }}</a></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid container-fixed-lg">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="card card-transparent">
                <ul class="nav nav-tabs nav-tabs-fillup hidden-sm-down" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#tab-m1" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-m1" aria-expanded="true"><span>{{ module_lang('Advertisements', 'tabs.list') }}</span></a>
                    </li>
                    @if($canAdd)
                        <li class="nav-item" role="presentation">
                            <a href="#tab-m2" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-m2" aria-expanded="false"><span>{{ module_lang('Advertisements', 'tabs.add') }}</span></a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-m1" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>

                                @if($canDelete)
                                    <div id="toolbar">
                                        <button id="remove" class="btn btn-danger" disabled>
                                            <i class="fas fa-trash-alt"></i> {{ module_lang('Dashboard', 'common.delete') }}
                                        </button>
                                    </div>
                                @endif

                                <table id="datatable" class="table-striped" data-page-size="15" data-page-list="[15, 25, 50, 100, 500, 1000]" data-show-refresh="true" data-sticky-header="true" data-filter-control="true" data-show-search-clear-button="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            @if($canDelete)
                                                <th data-field="state" data-checkbox="true"></th>
                                            @endif
                                            <th data-field="lp">{{ module_lang('Advertisements', 'table.lp') }}</th>
                                            <th data-field="adv_id" data-filter-control="input">{{ module_lang('Advertisements', 'table.id') }}</th>
                                            <th data-field="action">{{ module_lang('Dashboard', 'common.action') }}</th>
                                            <th data-field="adv_status" data-filter-control="select">{{ module_lang('Advertisements', 'table.status') }}</th>
                                            <th data-field="adv_reservation" data-filter-control="select">{{ module_lang('Advertisements', 'table.www_status') }}</th>
                                            <th data-field="adv_machine_type" data-filter-control="select">{{ module_lang('Advertisements', 'table.machine_type') }}</th>
                                            <th data-field="adv_producer" data-filter-control="select">{{ module_lang('Advertisements', 'table.producer') }}</th>
                                            <th data-field="adv_model" data-filter-control="input">{{ module_lang('Advertisements', 'table.model') }}</th>
                                            <th data-field="adv_year" data-filter-control="input">{{ module_lang('Advertisements', 'table.year') }}</th>
                                            <th data-field="adv_serial_number" data-filter-control="input">{{ module_lang('Advertisements', 'table.serial_number') }}</th>
                                            <th data-field="adv_state" data-filter-control="select">{{ module_lang('Advertisements', 'table.state') }}</th>
                                            <th data-field="adv_reservation_user_id" data-filter-control="select">{{ module_lang('Advertisements', 'table.reserved_by') }}</th>
                                            <th data-field="adv_location" data-filter-control="input">{{ module_lang('Advertisements', 'table.location') }}</th>
                                            <th data-field="adv_production_date" data-filter-control="input">{{ module_lang('Advertisements', 'table.production_date') }}</th>
                                            <th data-field="adv_price_netto" data-filter-control="input">{{ module_lang('Advertisements', 'table.price_netto') }}</th>
                                            <th data-field="adv_price" data-filter-control="input">{{ module_lang('Advertisements', 'table.price') }}</th>
                                            <th data-field="adv_register" data-filter-control="input">{{ module_lang('Advertisements', 'table.register') }}</th>
                                            <th data-field="adv_created_at" data-filter-control="input">{{ module_lang('Advertisements', 'table.created_at') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($canAdd)
                        <div class="tab-pane fade" id="tab-m2" role="tabpanel" aria-expanded="false">
                            <div class="row">
                                <div class="page_content">
                                    <div class="message">
                                        <div class="alert alert-info animate-show-hide" role="alert"></div>
                                    </div>
                                    @include('advertisements::partials.form-create')
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/advertisements-module.js') }}?v={{ filemtime(public_path('js/advertisements-module.js')) }}"></script>
@endpush
@endsection
