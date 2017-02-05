$(function(){
    var vm = new Vue({
        el: '#eventList',

        computed: {
            events: function(){
                var evs = [];
                for(var i = 0; i < testb.length; i++){
                    var e = testb[i];

                    e.month = displayMonth(this, moment(e.start.date).format('M'), true);
                    e.day_number = moment(e.start.date).format('D');
                    e.day_name = displayDay(this, moment(e.start.date).weekday(), true);

                    e.time_interval = moment(e.start.date).format('HH:mm');

                    evs.push(e);
                }
                return evs;
            }
        }
    });
});