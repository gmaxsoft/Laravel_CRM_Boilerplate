@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ module_lang('Users', 'breadcrumb.settings') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ module_lang('Users', 'breadcrumb.user_management') }}</a></li>
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
                        <a href="#tab-one" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-one" aria-expanded="true"><span>{{ module_lang('Users', 'tabs.list') }}</span></a>
                    </li>
                    @if($canAdd)
                        <li class="nav-item" role="presentation">
                            <a href="#tab-two" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-two" aria-expanded="false"><span>{{ module_lang('Users', 'tabs.add') }}</span></a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-expanded="true">
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

                                <table id="datatable" class="table-striped" data-page-list="[10, 25, 50, 100, all]" data-show-refresh="true" data-sticky-header="true" data-filter-control="true" data-show-search-clear-button="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th data-field="action">{{ module_lang('Dashboard', 'common.action') }}</th>
                                            <th data-field="lp">{{ module_lang('Users', 'table.lp') }}</th>
                                            <th data-field="user_id">{{ module_lang('Users', 'table.id') }}</th>
                                            <th data-field="first_name" data-filter-control="input">{{ module_lang('Users', 'table.first_name') }}</th>
                                            <th data-field="last_name" data-filter-control="input">{{ module_lang('Users', 'table.last_name') }}</th>
                                            <th data-field="email" data-filter-control="input">{{ module_lang('Users', 'table.email') }}</th>
                                            <th data-field="phone" data-filter-control="input">{{ module_lang('Users', 'table.phone') }}</th>
                                            <th data-field="stand_name" data-filter-control="select">{{ module_lang('Users', 'table.stand_name') }}</th>
                                            <th data-field="symbol" data-filter-control="input">{{ module_lang('Users', 'table.symbol') }}</th>
                                            <th data-field="department" data-filter-control="select">{{ module_lang('Users', 'table.department') }}</th>
                                            <th data-field="user_level" data-filter-control="select">{{ module_lang('Users', 'table.user_level') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($canAdd)
                        <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-expanded="false">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                @include('users::partials.form-create')
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/users-module.js') }}?v={{ filemtime(public_path('js/users-module.js')) }}"></script>
@endpush
@endsection
