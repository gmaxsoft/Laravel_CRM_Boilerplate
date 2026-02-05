<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ module_lang('Dashboard', 'app.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/themes/custom.css') }}?v={{ filemtime(public_path('css/themes/custom.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/themes/pages.css') }}?v={{ filemtime(public_path('css/themes/pages.css')) }}">
    @stack('styles')
</head>
<body class="fixed-header">
    <nav class="page-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-header-controls">
                <div class="desc-txt-nav">
                    <span style="color:#fff;font-weight:bold">{{ module_lang('Dashboard', 'app.nav') }}</span>
                    <button type="button" class="btn btn-link btnpin" style="color:#fff;padding:0;margin-left:10px;" title="{{ module_lang('Dashboard', 'app.collapse_menu') }}" aria-label="{{ module_lang('Dashboard', 'app.collapse_menu') }}">
                        <i class="bi bi-chevron-left sidebar-toggle-icon"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu-items">
                <li class="m-t-30">
                    <a href="{{ route('dashboard') }}" class="detailed">
                        <span class="title">{{ module_lang('Dashboard', 'menu.dashboard') }}</span>
                    </a>
                    <span class="icon-thumbnail"><i class="bi bi-speedometer2"></i></span>
                </li>
                <li>
                    <a href="/module/customers" class="detailed">
                        <span class="title">{{ module_lang('Dashboard', 'menu.customers') }}</span>
                    </a>
                    <span class="icon-thumbnail"><i class="bi bi-person-badge"></i></span>
                </li>
                <li>
                    <a href="/module/advertisements" class="detailed">
                        <span class="title">{{ module_lang('Dashboard', 'menu.advertisements') }}</span>
                    </a>
                    <span class="icon-thumbnail"><i class="bi bi-newspaper"></i></span>
                </li>
                <li>
                    <a href="/module/calendar" class="detailed">
                        <span class="title">{{ module_lang('Dashboard', 'menu.calendar') }}</span>
                    </a>
                    <span class="icon-thumbnail"><i class="bi bi-calendar"></i></span>
                </li>
                <li>
                    <a href="/module/documents" class="detailed">
                        <span class="title">{{ module_lang('Dashboard', 'menu.documents') }}</span>
                    </a>
                    <span class="icon-thumbnail"><i class="bi bi-file-earmark"></i></span>
                </li>
                <li>
                    <a href="javascript:;" class="detailed">
                        <span class="title">{{ module_lang('Dashboard', 'menu.administration') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail"><i class="bi bi-person-gear"></i></span>
                    <ul class="sub-menu">
                        <li>
                            <a href="/module/users" class="detailed">
                                <span class="title">{{ module_lang('Dashboard', 'menu.users') }}</span>
                            </a>
                            <span class="icon-thumbnail"><i class="bi bi-people"></i></span>
                        </li>
                        <li>
                            <a href="/module/access" class="detailed">
                                <span class="title">{{ module_lang('Dashboard', 'menu.access') }}</span>
                            </a>
                            <span class="icon-thumbnail"><i class="bi bi-shield-lock"></i></span>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="detailed">
                        <span class="title">{{ module_lang('Dashboard', 'menu.settings') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <span class="icon-thumbnail"><i class="bi bi-gear"></i></span>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ route('settings.calendar-categories.index') }}" class="detailed">
                                <span class="title">{{ module_lang('Dashboard', 'menu.calendar_categories') }}</span>
                            </a>
                            <span class="icon-thumbnail"><i class="bi bi-calendar-event"></i></span>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </nav>

    <button type="button" id="sidebar-expand-btn" class="sidebar-expand-btn d-none" title="{{ module_lang('Dashboard', 'app.expand_menu') }}" aria-label="{{ module_lang('Dashboard', 'app.expand_menu') }}">
        <i class="bi bi-chevron-right"></i>
    </button>

    <div class="page-container">
        <div class="header">
            <a href="#" class="toggle-sidebar d-lg-none" style="color:#626262;text-decoration:none;margin-right:15px;">
                <i class="bi bi-list" style="font-size:20px;"></i>
            </a>
            <div class="d-flex align-items-center flex-grow-1 justify-content-end flex-wrap gap-2">
                <span class="fs-14 font-heading semi-bold usertxt">
                    {{ module_trans('Dashboard', 'welcome') }}, <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>.
                    {{ module_trans('Dashboard', 'logged_as') }}: <strong>{{ auth()->user()->email }}</strong>
                    @if(auth()->user()->access)
                        · {{ module_trans('Dashboard', 'access_level') }}: <strong>{{ auth()->user()->access->name }}</strong>
                    @endif
                </span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link" style="color:#626262;text-decoration:none">
                        <i class="bi bi-box-arrow-right"></i> {{ module_lang('Dashboard', 'app.logout') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://unpkg.com/bootstrap-table@1.22.0/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://unpkg.com/bootstrap-table@1.22.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.0/dist/locale/bootstrap-table-pl-PL.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.js"></script>
    <link href="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.css" rel="stylesheet">
    <link href="https://unpkg.com/bootstrap-table@1.22.0/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.css" rel="stylesheet">
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-describedby="confirmDeleteModalBody" aria-hidden="true" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel" data-default="{{ module_lang('Dashboard', 'confirm_delete.title') }}"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ module_lang('Dashboard', 'common.close') }}"></button>
                </div>
                <div class="modal-body" id="confirmDeleteModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ module_lang('Dashboard', 'confirm_delete.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteModalConfirm">{{ module_lang('Dashboard', 'confirm_delete.confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    window.showConfirmModal = function(title, body, onConfirm) {
        const modalEl = document.getElementById('confirmDeleteModal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        const titleEl = document.getElementById('confirmDeleteModalLabel');
        const bodyEl = document.getElementById('confirmDeleteModalBody');
        const btn = document.getElementById('confirmDeleteModalConfirm');
        titleEl.textContent = title || (titleEl.getAttribute('data-default') || 'Usuwanie');
        bodyEl.textContent = body || 'Czy na pewno chcesz usunąć wybrane elementy?';
        modalEl.setAttribute('aria-hidden', 'false');
        modalEl.setAttribute('aria-modal', 'true');
        const handler = function() {
            btn.removeEventListener('click', handler);
            if (typeof onConfirm === 'function') onConfirm();
            modal.hide();
        };
        const hiddenHandler = function() {
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeEventListener('hidden.bs.modal', hiddenHandler);
        };
        modalEl.addEventListener('hidden.bs.modal', hiddenHandler);
        btn.addEventListener('click', handler);
        modal.show();
    };
    </script>
    <script src="{{ asset('js/jquery.inputmask.bundle.js') }}?v={{ filemtime(public_path('js/jquery.inputmask.bundle.js')) }}"></script>
    <script src="{{ asset('js/pages.js') }}?v={{ filemtime(public_path('js/pages.js')) }}"></script>
    <script src="{{ asset('js/custom.js') }}?v={{ filemtime(public_path('js/custom.js')) }}"></script>
    @stack('scripts')
</body>
</html>
