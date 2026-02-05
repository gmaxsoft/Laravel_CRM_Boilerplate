(function ($) {

    'use strict';

    /** Klucz w localStorage dla stanu zwinięcia menu bocznego */
    var STORAGE_KEY = 'crm_sidebar_collapsed';

    /** Podświetlenie aktywnej pozycji w menu */
    $(".menu-items li a").filter(function () {
        return location.href.match($(this).attr("href"));
    }).parent().find('span.icon-thumbnail').addClass("bg-success");

    /** Ustawia stan menu bocznego (zwinięty/rozwinięty) i zapisuje w localStorage */
    function setSidebarCollapsed(collapsed) {
        var $sidebar = $('.page-sidebar');
        var $container = $('.page-container');
        var $expandBtn = $('#sidebar-expand-btn');
        var $icon = $('.btnpin .sidebar-toggle-icon');

        if (collapsed) {
            $sidebar.addClass('slim');
            $container.addClass('page-smp');
            $('body').addClass('sidebar-collapsed');
            $expandBtn.removeClass('d-none');
            $icon.removeClass('bi-chevron-left').addClass('bi-chevron-right');
            $('.page_content').find('.white-desk').addClass('white-desk-short').removeClass('white-desk');
        } else {
            $sidebar.removeClass('slim');
            $container.removeClass('page-smp');
            $('body').removeClass('sidebar-collapsed');
            $expandBtn.addClass('d-none');
            $icon.removeClass('bi-chevron-right').addClass('bi-chevron-left');
            $('.page_content').find('.white-desk-short').addClass('white-desk').removeClass('white-desk-short');
        }
    }

    /** Przełącza stan menu bocznego */
    function toggleSidebar() {
        var collapsed = $('.page-sidebar').hasClass('slim');
        setSidebarCollapsed(!collapsed);
        try {
            localStorage.setItem(STORAGE_KEY, (!collapsed).toString());
        } catch (e) {}
    }

    // Stan z pamięci lokalnej przy ładowaniu
    (function applySavedState() {
        try {
            var saved = localStorage.getItem(STORAGE_KEY);
            if (saved === 'true') {
                setSidebarCollapsed(true);
            }
        } catch (e) {}
    })();

    $(".btnpin").on("click", function () {
        toggleSidebar();
    });

    $('#sidebar-expand-btn').on('click', function () {
        setSidebarCollapsed(false);
        try {
            localStorage.setItem(STORAGE_KEY, 'false');
        } catch (e) {}
    });

})(jQuery);
