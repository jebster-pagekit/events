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
                timeFormat: 'HH:mm',
                events: this.events
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
                    this.events.push(e);
                }

            }
        }

    })
});
