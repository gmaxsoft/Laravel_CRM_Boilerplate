@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('customers.index') }}">{{ module_lang('Customers', 'breadcrumb.customer_list') }}</a></li>
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
                        <a href="#tab-a" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-a" aria-expanded="true"><span>{{ module_lang('Customers', 'tabs.active') }}</span></a>
                    </li>
                    @if($canAdd)
                        <li class="nav-item" role="presentation">
                            <a href="#tab-c" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-c" aria-expanded="false"><span>{{ module_lang('Customers', 'tabs.add') }}</span></a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-a" aria-expanded="true">
                        <div class="row column-seperation">
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

                                <table id="datatable" class="table-striped" data-page-list="[15, 25, 50, 100, 500, 1000]" data-show-refresh="true" data-sticky-header="true" data-filter-control="true" data-show-search-clear-button="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            @if($canDelete)
                                                <th data-field="state" data-checkbox="true"></th>
                                            @endif
                                            <th data-field="action">{{ module_lang('Dashboard', 'common.action') }}</th>
                                            <th data-field="lp">{{ module_lang('Customers', 'table.lp') }}</th>
                                            <th data-field="customers_id" data-filter-control="input">{{ module_lang('Customers', 'table.id_crm') }}</th>
                                            <th data-field="customers_code" data-filter-control="input">{{ module_lang('Customers', 'table.id_dms') }}</th>
                                            <th data-field="customers_firmname" data-filter-control="input">{{ module_lang('Customers', 'table.firm') }}</th>
                                            <th data-field="customers_firstname" data-filter-control="input">{{ module_lang('Customers', 'table.first_name') }}</th>
                                            <th data-field="customers_lastname" data-filter-control="input">{{ module_lang('Customers', 'table.last_name') }}</th>
                                            <th data-field="customers_nip" data-filter-control="input">{{ module_lang('Customers', 'table.nip') }}</th>
                                            <th data-field="customers_email" data-filter-control="input">{{ module_lang('Customers', 'table.email') }}</th>
                                            <th data-field="customers_phone" data-filter-control="input">{{ module_lang('Customers', 'table.phone') }}</th>
                                            <th data-field="customers_area" data-filter-control="select">{{ module_lang('Customers', 'table.area') }}</th>
                                            <th data-field="customers_postcode" data-filter-control="input">{{ module_lang('Customers', 'table.postcode') }}</th>
                                            <th data-field="customers_county" data-filter-control="select">{{ module_lang('Customers', 'table.county') }}</th>
                                            <th data-field="customers_trader_id" data-filter-control="select">{{ module_lang('Customers', 'table.trader') }}</th>
                                            <th data-field="customers_rodo" data-filter-control="select">{{ module_lang('Customers', 'table.rodo') }}</th>
                                            <th data-field="customers_re_contact_date" data-filter-control="input">{{ module_lang('Customers', 'table.re_contact') }}</th>
                                            <th data-field="customers_agricultural_land" data-filter-control="input">{{ module_lang('Customers', 'table.area_ha') }}</th>
                                            <th data-field="customers_legalform" data-filter-control="select">{{ module_lang('Customers', 'table.legalform') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($canAdd)
                        <div class="tab-pane fade" id="tab-c" role="tabpanel" aria-expanded="false">
                            <div class="row">
                                <div class="page_content">
                                    <div class="message">
                                        <div class="alert alert-info animate-show-hide" role="alert"></div>
                                    </div>
                                    @include('customers::partials.form-create')
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
<script src="{{ asset('js/customers-module.js') }}?v={{ filemtime(public_path('js/customers-module.js')) }}"></script>
@endpush
@endsection
