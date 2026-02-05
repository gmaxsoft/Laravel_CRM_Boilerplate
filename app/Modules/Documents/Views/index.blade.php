@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('documents.index') }}">{{ module_lang('Documents', 'breadcrumb.documents') }}</a></li>
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
                        <a href="#tab-list" class="nav-link active" data-bs-toggle="tab" data-target="#tab-list" aria-expanded="true"><span>{{ module_lang('Documents', 'tabs.file_list') }}</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tab-upload" class="nav-link" data-bs-toggle="tab" data-target="#tab-upload" aria-expanded="true"><span>{{ module_lang('Documents', 'tabs.upload') }}</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-list" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                <table id="datatable" data-show-refresh="true" class="table-striped" data-page-list="[10, 25, 50, 100, all]" data-sticky-header="true" data-filter-control="true" data-show-search-clear-button="true">
                                    <thead>
                                        <tr>
                                            <th data-field="id">{{ module_lang('Documents', 'table.id') }}</th>
                                            <th data-field="original_name" data-filter-control="input">{{ module_lang('Documents', 'table.file_name') }}</th>
                                            <th data-field="size" data-filter-control="input">{{ module_lang('Documents', 'table.size') }}</th>
                                            <th data-field="mime_type" data-filter-control="input">{{ module_lang('Documents', 'table.type') }}</th>
                                            <th data-field="uploaded_by" data-filter-control="input">{{ module_lang('Documents', 'table.uploaded_by') }}</th>
                                            <th data-field="created_at">{{ module_lang('Documents', 'table.date') }}</th>
                                            <th data-field="action">{{ module_lang('Dashboard', 'common.action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-upload" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                <form method="POST" id="form_upload" name="form_upload" enctype="multipart/form-data" style="width:100%;">
                                    @csrf
                                    <div class="title-box">{{ module_lang('Documents', 'form.title') }}</div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="file">{{ module_lang('Documents', 'form.file') }}</label>
                                                <input type="file" class="form-control" id="file" name="file" required />
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> {{ module_lang('Documents', 'form.upload') }}</button>
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
<script src="{{ asset('js/documents-module.js') }}?v={{ filemtime(public_path('js/documents-module.js')) }}"></script>
@endpush
