@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('settings.calendar-categories.index') }}">{{ module_lang('Settings', 'breadcrumb.settings') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('settings.calendar-categories.index') }}">{{ module_lang('Settings', 'breadcrumb.calendar_categories') }}</a></li>
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
                        <a href="#tab-a1" class="nav-link active" data-bs-toggle="tab" data-target="#tab-a1" aria-expanded="true"><span>{{ module_lang('Settings', 'tabs.list') }}</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tab-b2" class="nav-link" data-bs-toggle="tab" data-target="#tab-b2" aria-expanded="true"><span>{{ module_lang('Settings', 'tabs.add') }}</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-a1" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                <table id="datatable" data-show-refresh="true" class="table-striped" data-page-list="[10, 25, 50, 100, all]" data-sticky-header="true" data-filter-control="true" data-show-search-clear-button="true" data-toolbar="#toolbar" data-reorderable-rows="true" data-use-row-attr-func="true">
                                    <thead>
                                        <tr>
                                            <th data-field="cal_cat_id">{{ module_lang('Settings', 'table.id') }}</th>
                                            <th data-field="cal_cat_name" data-filter-control="input">{{ module_lang('Settings', 'table.name') }}</th>
                                            <th data-field="cal_cat_value" data-filter-control="select">{{ module_lang('Settings', 'table.color') }}</th>
                                            <th data-field="action">{{ module_lang('Dashboard', 'common.action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-b2" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                <form method="POST" id="form_block" name="form_block" style="width:100%;">
                                    @csrf
                                    <div class="title-box">{{ module_lang('Settings', 'form.title') }}</div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cal_cat_name">{{ module_lang('Settings', 'form.event_name') }}</label>
                                                <input type="text" autocomplete="off" class="form-control" id="cal_cat_name" name="cal_cat_name" placeholder="{{ module_lang('Settings', 'form.placeholder_name') }}" required autofocus tabindex="1" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cal_cat_value">{{ module_lang('Settings', 'form.event_color') }}</label>
                                                <select class="form-control" autocomplete="off" id="cal_cat_value" name="cal_cat_value" required>
                                                    <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                                                    <option value="bg-primary">{{ module_lang('Settings', 'form.colors.blue') }}</option>
                                                    <option value="bg-secondary">{{ module_lang('Settings', 'form.colors.grey') }}</option>
                                                    <option value="bg-success">{{ module_lang('Settings', 'form.colors.green') }}</option>
                                                    <option value="bg-danger">{{ module_lang('Settings', 'form.colors.red') }}</option>
                                                    <option value="bg-warning">{{ module_lang('Settings', 'form.colors.yellow') }}</option>
                                                    <option value="bg-info">{{ module_lang('Settings', 'form.colors.info') }}</option>
                                                    <option value="bg-light">{{ module_lang('Settings', 'form.colors.light') }}</option>
                                                    <option value="bg-dark">{{ module_lang('Settings', 'form.colors.dark') }}</option>
                                                    <option value="bg-workshop">{{ module_lang('Settings', 'form.colors.workshop') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ module_lang('Settings', 'form.add') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/settings-calendar-categories.js') }}?v={{ filemtime(public_path('js/settings-calendar-categories.js')) }}"></script>
@endpush
