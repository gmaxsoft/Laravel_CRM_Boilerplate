@extends('layouts.app')

@section('content')
<div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ module_lang('Dashboard', 'app.breadcrumb_start') }}</a></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid container-fixed-lg">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="card card-transparent">
                <div class="card-body">
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6 col-md-3">
                            <a href="/module/customers" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <span class="rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="width: 48px; height: 48px;">
                                                <i class="bi bi-person-badge fs-4"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="fs-3 fw-bold text-dark">{{ number_format($stats['customers']) }}</div>
                                            <div class="text-muted small">{{ module_trans('Dashboard', 'stats.customers') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="/module/advertisements" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <span class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width: 48px; height: 48px;">
                                                <i class="bi bi-newspaper fs-4"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="fs-3 fw-bold text-dark">{{ number_format($stats['advertisements']) }}</div>
                                            <div class="text-muted small">{{ module_trans('Dashboard', 'stats.advertisements') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="/module/calendar" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <span class="rounded-circle d-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info" style="width: 48px; height: 48px;">
                                                <i class="bi bi-calendar-event fs-4"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="fs-3 fw-bold text-dark">{{ number_format($stats['calendar_events']) }}</div>
                                            <div class="text-muted small">{{ module_trans('Dashboard', 'stats.calendar_events') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="/module/users" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <span class="rounded-circle d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-secondary" style="width: 48px; height: 48px;">
                                                <i class="bi bi-people fs-4"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="fs-3 fw-bold text-dark">{{ number_format($stats['users']) }}</div>
                                            <div class="text-muted small">{{ module_trans('Dashboard', 'stats.users') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-5">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">{{ module_trans('Dashboard', 'stats.chart_title') }}</h6>
                                    <div style="position: relative; height: 220px; width: 100%;">
                                        <canvas id="dashboardChart"></canvas>
                                    </div>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function () {
    var ctx = document.getElementById('dashboardChart');
    if (!ctx) return;
    var data = {
        labels: [
            '{{ module_trans('Dashboard', 'stats.customers') }}',
            '{{ module_trans('Dashboard', 'stats.advertisements') }}',
            '{{ module_trans('Dashboard', 'stats.calendar_events') }}',
            '{{ module_trans('Dashboard', 'stats.users') }}'
        ],
        datasets: [{
            data: [{{ $stats['customers'] }}, {{ $stats['advertisements'] }}, {{ $stats['calendar_events'] }}, {{ $stats['users'] }}],
            backgroundColor: ['rgba(13, 110, 253, 0.8)', 'rgba(25, 135, 84, 0.8)', 'rgba(13, 202, 240, 0.8)', 'rgba(108, 117, 125, 0.8)'],
            borderWidth: 0
        }]
    };
    new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
})();
</script>
@endpush
