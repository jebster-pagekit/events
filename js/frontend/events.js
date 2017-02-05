$(function(){

    var vm = new Vue({
        el: '#events',

        data: {
            ev: window.$data.events,
            events: []
        },

        ready: function () {
            this.load();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },

                navLinks: true, // can click day/week names to navigate views
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: this.events,

                weekNumbers: false,
                theme: true,
                themeButtonIcons: {
                    prev: 'arrowthick-1-w',
                    next: 'arrowthick-1-e',
                    prevYear: 'seek-prev',
                    nextYear: 'seek-next'
                },
                // Locale
                views: {
                    basic: {
                        columnFormat: 'ddd',
                    },
                    agenda: {
                    },
                    week: {
                        columnFormat: 'ddd D/M',
                    },
                    day: {
                        columnFormat: 'dddd',
                    }
                },
                timeFormat: 'HH:mm',
                monthNames: [
                    this.$trans('January'),
                    this.$trans('February'),
                    this.$trans('March'),
                    this.$trans('April'),
                    this.$trans('May'),
                    this.$trans('June'),
                    this.$trans('July'),
                    this.$trans('August'),
                    this.$trans('September'),
                    this.$trans('October'),
                    this.$trans('November'),
                    this.$trans('December'),
                ],
                monthNamesShort: [
                    this.$trans('Jan'),
                    this.$trans('Feb'),
                    this.$trans('Mar'),
                    this.$trans('Apr'),
                    this.$trans('May'),
                    this.$trans('Jun'),
                    this.$trans('Jul'),
                    this.$trans('Aug'),
                    this.$trans('Sep'),
                    this.$trans('Oct'),
                    this.$trans('Nov'),
                    this.$trans('Dec')
                ],
                dayNames: [
                    this.$trans('Sunday'),
                    this.$trans('Monday'),
                    this.$trans('Tuesday'),
                    this.$trans('Wednesday'),
                    this.$trans('Thursday'),
                    this.$trans('Friday'),
                    this.$trans('Saturday'),
                ],
                dayNamesShort: [
                    this.$trans('Sun'),
                    this.$trans('Mon'),
                    this.$trans('Tue'),
                    this.$trans('Wed'),
                    this.$trans('Thu'),
                    this.$trans('Fri'),
                    this.$trans('Sat'),
                ],
                buttonText: {
                    today:    this.$trans('Today'),
                    month:    this.$trans('Month'),
                    week:     this.$trans('Week'),
                    day:      this.$trans('Day'),
                    list:     this.$trans('Agenda')
                },
                allDayText: this.$trans('All day')
            });
        },

        methods: {
            load: function(){
                this.events = [];
                for(var i = 0; i < this.ev.length; i++){
                    var e = this.ev[i];
                    e.start = e.start.date;
                    e.end = e.end.date;
                    e.url = 'events/'+e.id;
                    e.color = '#c00';
                    this.events.push(e);
                }

            }
        }

    })
});
