@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ module_lang('Users', 'breadcrumb.user_management') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('users.edit', $user->id) }}">{{ module_lang('Users', 'breadcrumb.user_data') }}</a></li>
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
                        <a href="#tab-us1" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-us1" aria-expanded="true"><span>{{ module_lang('Users', 'tabs.edit_data') }}</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tab-us2" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-us2" aria-expanded="true"><span>{{ module_lang('Users', 'tabs.change_password') }}</span></a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" role="tabpanel" id="tab-us1" aria-expanded="false">
                        <div class="message">
                            <div class="alert alert-info animate-show-hide" role="alert"></div>
                        </div>
                        @include('users::partials.form-edit')
                    </div>
                    <div class="tab-pane fade" id="tab-us2" role="tabpanel" aria-expanded="false">
                        <div class="page_content">
                            <div class="row">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                @include('users::partials.form-password')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/users-module-edit.js') }}?v={{ filemtime(public_path('js/users-module-edit.js')) }}"></script>
@endpush
@endsection
