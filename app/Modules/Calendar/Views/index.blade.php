@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('calendar.index') }}">{{ module_lang('Calendar', 'breadcrumb.calendar') }}</a></li>
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
                        <a href="#tab-a" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-a" aria-expanded="true"><span>{{ module_lang('Calendar', 'tabs.calendar') }}</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tab-b" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-b" aria-expanded="false"><span>{{ module_lang('Calendar', 'tabs.events_list') }}</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-a" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="col-12">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="d-grid">
                                                    <button class="btn btn-lg font-16 btn-danger" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i> {{ module_lang('Calendar', 'buttons.new_event') }}</button>
                                                </div>
                                                <div id="external-events" class="m-t-20">
                                                    <br>
                                                    <p class="text-muted">{{ module_lang('Calendar', 'hint') }}</p>
                                                    @foreach($categories as $category)
                                                        <div class="external-event {{ $category->cal_cat_value }}" data-class="{{ $category->cal_cat_value }}">
                                                            <i class="bi bi-circle-fill me-2"></i>{{ $category->cal_cat_name }}
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="mt-5 d-none d-xl-block">
                                                    <h5 class="text-center">{{ module_lang('Calendar', 'notes_title') }}</h5>
                                                    <ul class="ps-3">
                                                        <li class="text-muted mb-3">
                                                            {{ module_lang('Calendar', 'notes_info') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-lg-9">
                                                <div class="mt-4 mt-lg-0">
                                                    <div id="calendar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-describedby="event-modal-body" aria-hidden="true" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="needs-validation" name="event-form" id="form-event" novalidate="">
                                                <div class="modal-header py-3 px-4 border-bottom-0">
                                                    <h5 class="modal-title" id="modal-title"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ module_lang('Dashboard', 'common.close') }}"></button>
                                                </div>
                                                <div class="modal-body px-4 pb-4 pt-0" id="event-modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="control-label form-label">{{ module_lang('Calendar', 'form.event_name') }}</label>
                                                                <input class="form-control" placeholder="{{ module_lang('Calendar', 'form.placeholder_name') }}" type="text" name="title" id="event-title" required="">
                                                                <div class="invalid-feedback">{{ module_lang('Calendar', 'form.invalid_name') }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="control-label form-label">{{ module_lang('Calendar', 'form.category') }}</label>
                                                                <select class="form-select" name="category" id="event-category" required="">
                                                                    <option value="">{{ module_lang('Calendar', 'form.select') }}</option>
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->cal_cat_value }}">{{ $category->cal_cat_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="invalid-feedback">{{ module_lang('Calendar', 'form.invalid_category') }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="control-label form-label">{{ module_lang('Calendar', 'form.start_time') }}</label>
                                                                <input class="form-control" placeholder="{{ module_lang('Calendar', 'form.placeholder_start') }}" type="datetime-local" name="start" id="event-start" required value="{{ date('Y-m-d\TH:i') }}" step="60">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="control-label form-label">{{ module_lang('Calendar', 'form.end_time') }}</label>
                                                                <input class="form-control" placeholder="{{ module_lang('Calendar', 'form.placeholder_end') }}" type="datetime-local" name="end" id="event-end" required value="{{ date('Y-m-d\TH:i') }}" step="60">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="control-label form-label">{{ module_lang('Calendar', 'form.notes') }}</label>
                                                                <textarea class="form-control" type="text" name="annotations" id="event-annotations" rows="3" style="height:105px!important"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="hidden" name='event-id' id="event-id" value="" />
                                                            <button type="button" class="btn btn-danger" id="btn-delete-event">Usuń</button>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">{{ module_lang('Calendar', 'buttons.close') }}</button>
                                                            <button type="submit" class="btn btn-success" id="btn-save-event">{{ module_lang('Calendar', 'buttons.save') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-b" role="tabpanel" aria-expanded="false">
                        <div class="row column-seperation">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>

                                <div id="toolbar">
                                    <button id="remove" class="btn btn-danger" disabled>
                                        <i class="fas fa-trash-alt"></i> {{ module_lang('Dashboard', 'common.delete') }}
                                    </button>
                                </div>

                                <table id="datatable" data-auto-refresh="true" class="table-striped" data-page-list="[10, 25, 50, 100, all]" data-sticky-header="true" data-filter-control="true" data-show-search-clear-button="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th data-field="lp">{{ module_lang('Calendar', 'table.lp') }}</th>
                                            <th data-field="cal_id" data-filter-control="input">{{ module_lang('Calendar', 'table.id') }}</th>
                                            <th data-field="cal_name" data-filter-control="input">{{ module_lang('Calendar', 'table.event_name') }}</th>
                                            <th data-field="cal_category" data-filter-control="select">{{ module_lang('Calendar', 'table.category') }}</th>
                                            <th data-field="cal_start" data-filter-control="input">{{ module_lang('Calendar', 'table.date_from') }}</th>
                                            <th data-field="cal_end" data-filter-control="input">{{ module_lang('Calendar', 'table.date_to') }}</th>
                                            <th data-field="cal_annotations" data-filter-control="input">{{ module_lang('Calendar', 'table.annotations') }}</th>
                                            <th data-field="cal_user_id" data-filter-control="input">{{ module_lang('Calendar', 'table.added_by') }}</th>
                                            <th data-field="created_at" data-filter-control="input">{{ module_lang('Calendar', 'table.created_at') }}</th>
                                            <th data-field="action">{{ module_lang('Dashboard', 'common.action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<link href="{{ asset('lib/fullcalendar/fullcalendar.min.css') }}?v={{ filemtime(public_path('lib/fullcalendar/fullcalendar.min.css')) }}" rel="stylesheet">
<style>
    .external-event {
        cursor: move;
        margin: 10px 0;
        padding: 8px 10px;
        color: #fff;
        border-radius: 4px;
    }
    .fc {
        font-family: inherit;
    }
</style>
@endpush
@push('scripts')
@php
    $calendarLang = [
        'add_event' => module_lang('Calendar', 'modal.add_event'),
        'edit_event' => module_lang('Calendar', 'modal.edit_event'),
        'today' => module_lang('Calendar', 'buttons.today'),
        'month' => module_lang('Calendar', 'buttons.month'),
        'week' => module_lang('Calendar', 'buttons.week'),
        'day' => module_lang('Calendar', 'buttons.day'),
        'list' => module_lang('Calendar', 'buttons.list'),
        'prev' => module_lang('Calendar', 'buttons.prev'),
        'next' => module_lang('Calendar', 'buttons.next'),
        'error_default' => module_lang('Calendar', 'errors.default'),
    ];
@endphp
<script src="{{ asset('lib/fullcalendar/fullcalendar.min.js') }}?v={{ filemtime(public_path('lib/fullcalendar/fullcalendar.min.js')) }}"></script>
<script src="{{ asset('lib/fullcalendar/locales-all.global.min.js') }}?v={{ filemtime(public_path('lib/fullcalendar/locales-all.global.min.js')) }}"></script>
<script>
    window.calendarLang = @json($calendarLang);
    window.calendarLocale = @json(app()->getLocale() === 'pl' ? 'pl' : 'en');
    let user_id = {{ auth()->id() }};
</script>
<script src="{{ asset('js/calendar-module.js') }}?v={{ filemtime(public_path('js/calendar-module.js')) }}"></script>
<script src="{{ asset('js/calendar-list.js') }}?v={{ filemtime(public_path('js/calendar-list.js')) }}"></script>
@endpush
@endsection
