$(function(){
    var vm = new Vue({
        el: '#eventList',

        computed: {
            events: function(){
                var evs = [];
                for(var i = 0; i < testb.length; i++){
                    var e = testb[i];

                    e.month = displayMonth(this, moment(e.start).format('M'), true);
                    e.day_number = moment(e.start).format('D');
                    e.day_name = displayDay(this, moment(e.start).weekday(), true);

                    e.time_interval = moment(e.start).format('HH:mm');

                    e.link = e.slug;

                    evs.push(e);
                }
                return evs;
            }
        }
    });
});