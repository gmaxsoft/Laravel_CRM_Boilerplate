@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Start</a></li>
                <li class="breadcrumb-item"><a href="{{ route('access.index') }}">Uprawnienia</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('access.edit', $access->id) }}">Edycja</a></li>
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
                        <a href="#tab-us1" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-us1" aria-expanded="true"><span>Edycja danych</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" role="tabpanel" id="tab-us1" aria-expanded="false">
                        <div class="page_content">
                            <div class="row">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                @include('access::partials.form-edit')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/access-module-edit.js') }}?v={{ filemtime(public_path('js/access-module-edit.js')) }}"></script>
@endpush
@endsection
