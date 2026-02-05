@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Start</a></li>
                <li class="breadcrumb-item"><a href="{{ route('settings.calendar-categories.index') }}">Ustawienia</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('settings.calendar-categories.edit', $category->cal_cat_id) }}">Edycja</a></li>
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
                        <a href="#tab-us1" class="nav-link active" data-bs-toggle="tab" data-target="#tab-us1" aria-expanded="true"><span>Edycja danych</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" role="tabpanel" id="tab-us1" aria-expanded="false">
                        <div class="page_content">
                            <div class="row">
                                <div class="message">
                                    <div class="alert alert-info animate-show-hide" role="alert"></div>
                                </div>
                                <form method="POST" id="form_block" name="form_block" style="width:100%;">
                                    @csrf
                                    @method('PUT')
                                    <div class="title-box">Edycja</div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cal_cat_name">Nazwa wydarzenia</label>
                                                <input type="text" autocomplete="off" class="form-control" id="cal_cat_name" name="cal_cat_name" placeholder="Wpisz nazwę kategorii" required autofocus tabindex="1" value="{{ old('cal_cat_name', $category->cal_cat_name) }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cal_cat_value">Kolor wydarzenia</label>
                                                <select class="form-control" autocomplete="off" id="cal_cat_value" name="cal_cat_value" required tabindex="2">
                                                    <option value="" {{ old('cal_cat_value', $category->cal_cat_value) == '' ? 'selected' : '' }}>Wybierz</option>
                                                    <option value="bg-primary" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-primary' ? 'selected' : '' }}>Niebieski</option>
                                                    <option value="bg-secondary" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-secondary' ? 'selected' : '' }}>Szary</option>
                                                    <option value="bg-success" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-success' ? 'selected' : '' }}>Zielony</option>
                                                    <option value="bg-danger" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-danger' ? 'selected' : '' }}>Czerwony</option>
                                                    <option value="bg-warning" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-warning' ? 'selected' : '' }}>Żółty</option>
                                                    <option value="bg-info" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-info' ? 'selected' : '' }}>Seledynowy</option>
                                                    <option value="bg-light" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-light' ? 'selected' : '' }}>Ciemny biały</option>
                                                    <option value="bg-dark" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-dark' ? 'selected' : '' }}>Jasny Czarny</option>
                                                    <option value="bg-workshop" {{ old('cal_cat_value', $category->cal_cat_value) == 'bg-workshop' ? 'selected' : '' }}>Warsztaty (żółty)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="{{ $category->cal_cat_id }}">
                                            <button type="submit" class="btn btn-primary">Uaktualnij</button>
                                            <button type="button" class="btn btn-danger backtolist">Powrót do listy</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div>&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/settings-calendar-categories-edit.js') }}?v={{ filemtime(public_path('js/settings-calendar-categories-edit.js')) }}"></script>
@endpush
