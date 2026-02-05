@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('access.index') }}">{{ module_lang('Access', 'breadcrumb.settings') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('access.index') }}">{{ module_lang('Access', 'breadcrumb.access') }}</a></li>
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
                        <a href="#tab-m1" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-m1" aria-expanded="true"><span>{{ module_lang('Access', 'tabs.list') }}</span></a>
                    </li>
                    @if($canAdd)
                        <li class="nav-item" role="presentation">
                            <a href="#tab-m2" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-m2" aria-expanded="false"><span>{{ module_lang('Access', 'tabs.add') }}</span></a>
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
                                <table id="datatable" data-show-refresh="true" class="table-striped" data-page-list="[10, 25, 50, 100, all]" data-sticky-header="true" data-filter-control="true" data-show-search-clear-button="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            @if($canDelete)
                                                <th data-field="state" data-checkbox="true"></th>
                                            @endif
                                            <th data-field="id">{{ module_lang('Access', 'table.id') }}</th>
                                            <th data-field="name" data-filter-control="input">{{ module_lang('Access', 'table.name') }}</th>
                                            <th data-field="level" data-filter-control="input">{{ module_lang('Access', 'table.level') }}</th>
                                            <th data-field="action">{{ module_lang('Dashboard', 'common.action') }}</th>
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
                                    @include('access::partials.form-create')
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
<script src="{{ asset('js/access-module.js') }}?v={{ filemtime(public_path('js/access-module.js')) }}"></script>
@endpush
@endsection
