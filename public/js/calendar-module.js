! function (l) {
    "use strict";
    function e() {
        this.$body = l("body"), this.$modal = new bootstrap.Modal(document.getElementById("event-modal"), {
            backdrop: "static"
        }), this.$calendar = l("#calendar"), this.$formEvent = l("#form-event"), this.$btnNewEvent = l("#btn-new-event"), this.$btnDeleteEvent = l("#btn-delete-event"), this.$btnSaveEvent = l("#btn-save-event"), this.$modalTitle = l("#modal-title"), this.$calendarObj = null, this.$selectedEvent = null, this.$newEventData = null
    }
    e.prototype.onEventClick = function (e) {
        this.$formEvent[0].reset(), this.$formEvent.removeClass("was-validated"), this.$newEventData = null, this.$btnDeleteEvent.show(), this.$modalTitle.text(window.calendarLang && window.calendarLang.edit_event ? window.calendarLang.edit_event : "Edytuj wydarzenie"), this.$modal.show(), this.$selectedEvent = e.event, l("#event-title").val(this.$selectedEvent.title), l("#event-annotations").val(this.$selectedEvent.extendedProps && this.$selectedEvent.extendedProps.description ? this.$selectedEvent.extendedProps.description : (this.$selectedEvent.description || '')), l("#event-category").val(this.$selectedEvent.classNames && this.$selectedEvent.classNames.length > 0 ? this.$selectedEvent.classNames[0] : (this.$selectedEvent.className || '')), l("#event-id").val(this.$selectedEvent.id), l("#event-start").val(this.$selectedEvent.start ? this.$selectedEvent.start.toISOString().slice(0, 16).replace('T', ' ') : ''), l("#event-end").val(this.$selectedEvent.end ? this.$selectedEvent.end.toISOString().slice(0, 16).replace('T', ' ') : '')
    },     e.prototype.onSelect = function (e) {
        this.$formEvent[0].reset(), this.$formEvent.removeClass("was-validated"), this.$selectedEvent = null, this.$newEventData = e, this.$btnDeleteEvent.hide(), this.$modalTitle.text(window.calendarLang && window.calendarLang.add_event ? window.calendarLang.add_event : "Dodaj wydarzenie");
        var dateStr = e.dateStr ? e.dateStr : (e.date ? e.date.toISOString().slice(0, 10) : new Date().toISOString().slice(0, 10));
        var timeStr = new Date().toTimeString().slice(0, 5);
        l("#event-start").val(dateStr + 'T' + timeStr);
        l("#event-end").val(dateStr + 'T' + timeStr);
        this.$modal.show();
        this.$calendarObj.unselect();
    }, e.prototype.init = function () {
        var e = new Date(l.now());
        new FullCalendar.Draggable(document.getElementById("external-events"), {
            itemSelector: ".external-event",
            eventData: function (el) {
                // Pobierz tekst bez ikony (usunięcie wszystkich znaków przed pierwszą literą)
                var text = el.innerText.trim();
                return {
                    title: text,
                    className: l(el).data("class")
                }
            }
        });
        var t = [],
            a = this;
        a.$calendarObj = new FullCalendar.Calendar(a.$calendar[0], {
            events: '/module/calendar/json',
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            slotDuration: "00:30:00",
            slotMinTime: "08:00:00",
            slotMaxTime: "20:00:00",
            themeSystem: "bootstrap",
            bootstrapFontAwesome: !1,
            buttonText: window.calendarLang ? {
                today: window.calendarLang.today,
                month: window.calendarLang.month,
                week: window.calendarLang.week,
                day: window.calendarLang.day,
                list: window.calendarLang.list,
                prev: window.calendarLang.prev,
                next: window.calendarLang.next
            } : { today: "Dziś", month: "Miesiąc", week: "Tydzień", day: "Dzień", list: "Lista", prev: "Wstecz", next: "Dalej" },
            locale: (window.calendarLocale || 'pl'),
            timeZone: 'Europe/Warsaw',
            initialView: "dayGridMonth",
            handleWindowResize: !0,
            height: l(window).height() - 200,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            },
            editable: !0,
            droppable: !0,
            selectable: !0,
            dateClick: function (e) {
                a.onSelect(e)
            },
            eventClick: function (e) {
                a.onEventClick(e)
            },
            eventReceive: function (info) {
                // Gdy przeciągnięto wydarzenie z listy kategorii
                var event = info.event;
                var startDate = event.start;
                var endDate = event.end || new Date(startDate.getTime() + 60 * 60 * 1000); // Domyślnie 1 godzina
                
                // Usuń tymczasowe wydarzenie z kalendarza
                event.remove();
                
                // Otwórz modal z wypełnionymi danymi
                a.$formEvent[0].reset();
                a.$formEvent.removeClass("was-validated");
                a.$selectedEvent = null;
                a.$newEventData = { date: startDate, allDay: event.allDay };
                a.$btnDeleteEvent.hide();
                a.$modalTitle.text(window.calendarLang && window.calendarLang.add_event ? window.calendarLang.add_event : "Dodaj wydarzenie");
                
                l("#event-title").val(event.title);
                l("#event-category").val(event.classNames && event.classNames.length > 0 ? event.classNames[0] : (event.className || ''));
                
                var startStr = startDate.toISOString().slice(0, 16).replace('T', ' ');
                var endStr = endDate.toISOString().slice(0, 16).replace('T', ' ');
                
                l("#event-start").val(startStr);
                l("#event-end").val(endStr);
                
                a.$modal.show();
            }
        });
        a.$calendarObj.render();
        a.$btnNewEvent.on("click", function (e) {
            var now = new Date();
            a.onSelect({
                dateStr: now.toISOString().slice(0, 10),
                date: now,
                allDay: !0
            })
        }), a.$formEvent.on("submit", function (e) {
            e.preventDefault();
            var t, n = a.$formEvent[0];
            if (n.checkValidity()) {
                if (a.$selectedEvent) {
                    // Update existing event
                    a.$selectedEvent.setProp("title", l("#event-title").val());
                    a.$selectedEvent.setProp("classNames", [l("#event-category").val()]);
                    $.ajax({
                        url: '/module/calendar/update/' + l("#event-id").val(),
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            title: l("#event-title").val(),
                            start: l("#event-start").val(),
                            end: l("#event-end").val(),
                            annotations: l("#event-annotations").val(),
                            category: l("#event-category").val()
                        },
                        type: "POST",
                        success: function (response) {
                            a.$calendarObj.refetchEvents();
                            $('#datatable').bootstrapTable('refresh', {
                                url: '/module/calendar/grid'
                            });
                            var alertEl = $(".message").find('.alert');
                            alertEl.removeClass('alert-danger').addClass('alert-info').html(response).show(500);
                            setTimeout(function () {
                                alertEl.fadeOut("slow", function() {
                                    alertEl.html('');
                                });
                            }, 5000);
                            a.$modal.hide();
                        },
                        error: function (error) {
                            var errorMsg = (window.calendarLang && window.calendarLang.error_default) ? window.calendarLang.error_default : 'Coś poszło nie tak!...';
                            if (error.responseJSON && error.responseJSON.message) {
                                errorMsg = error.responseJSON.message;
                            } else if (error.responseJSON && error.responseJSON.errors) {
                                var errors = [];
                                $.each(error.responseJSON.errors, function(key, value) {
                                    errors.push(value[0]);
                                });
                                errorMsg = errors.join('<br>');
                            }
                            var alertEl = $(".message").find('.alert');
                            alertEl.removeClass('alert-info').addClass('alert-danger').html(errorMsg).show(500);
                            setTimeout(function () {
                                alertEl.fadeOut("slow", function() {
                                    alertEl.html('');
                                });
                            }, 5000);
                        }
                    });
                } else {
                    // Add new event
                    $.ajax({
                        url: '/module/calendar/store',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            title: l("#event-title").val(),
                            start: l("#event-start").val(),
                            end: l("#event-end").val(),
                            annotations: l("#event-annotations").val(),
                            category: l("#event-category").val()
                        },
                        type: "POST",
                        success: function (response) {
                            a.$calendarObj.refetchEvents();
                            $('#datatable').bootstrapTable('refresh', {
                                url: '/module/calendar/grid'
                            });
                            var alertEl = $(".message").find('.alert');
                            alertEl.removeClass('alert-danger').addClass('alert-info').html(response).show(500);
                            setTimeout(function () {
                                alertEl.fadeOut("slow", function() {
                                    alertEl.html('');
                                });
                            }, 5000);
                            a.$modal.hide();
                        },
                        error: function (error) {
                            var errorMsg = (window.calendarLang && window.calendarLang.error_default) ? window.calendarLang.error_default : 'Coś poszło nie tak!...';
                            if (error.responseJSON && error.responseJSON.message) {
                                errorMsg = error.responseJSON.message;
                            } else if (error.responseJSON && error.responseJSON.errors) {
                                var errors = [];
                                $.each(error.responseJSON.errors, function(key, value) {
                                    errors.push(value[0]);
                                });
                                errorMsg = errors.join('<br>');
                            }
                            var alertEl = $(".message").find('.alert');
                            alertEl.removeClass('alert-info').addClass('alert-danger').html(errorMsg).show(500);
                            setTimeout(function () {
                                alertEl.fadeOut("slow", function() {
                                    alertEl.html('');
                                });
                            }, 5000);
                        }
                    });
                }
            } else {
                e.stopPropagation(), n.classList.add("was-validated")
            }
        }), l(a.$btnDeleteEvent.on("click", function (e) {
            if (a.$selectedEvent) {
                $.ajax({
                    url: '/module/calendar/delete/' + a.$selectedEvent.id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    success: function (response) {
                        a.$selectedEvent.remove();
                        a.$selectedEvent = null;
                        a.$modal.hide();
                        a.$calendarObj.refetchEvents();
                        $('#datatable').bootstrapTable('refresh', {
                            url: '/module/calendar/grid'
                        });
                        var alertEl = $(".message").find('.alert');
                        alertEl.removeClass('alert-danger').addClass('alert-info').html(response).show(500);
                        setTimeout(function () {
                            alertEl.fadeOut("slow", function() {
                                alertEl.html('');
                            });
                        }, 5000);
                    },
                    error: function (error) {
                        var errorMsg = (window.calendarLang && window.calendarLang.error_default) ? window.calendarLang.error_default : 'Coś poszło nie tak!...';
                        if (error.responseJSON && error.responseJSON.message) {
                            errorMsg = error.responseJSON.message;
                        }
                        var alertEl = $(".message").find('.alert');
                        alertEl.removeClass('alert-info').addClass('alert-danger').html(errorMsg).show(500);
                        setTimeout(function () {
                            alertEl.fadeOut("slow", function() {
                                alertEl.html('');
                            });
                        }, 5000);
                    }
                });
            }
        }))
    }, l.CalendarApp = new e, l.CalendarApp.Constructor = e
}(window.jQuery),
    function () {
        "use strict";
        window.jQuery.CalendarApp.init()
    }();
