@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Start</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">baza klientów</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('customers.edit', $customer->customers_id) }}">Szczegóły dotyczące klienta</a></li>
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
                        <a href="#tab-a" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-a" aria-expanded="true"><span>Dane klienta</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-a" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="page_content">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                @include('customers::partials.form-edit')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/customers-module-edit.js') }}?v={{ filemtime(public_path('js/customers-module-edit.js')) }}"></script>
@endpush
@endsection
