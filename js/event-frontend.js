$(function(){

    var vm = new Vue({
        el: '#event',

        data: {
            ev: window.$data.event
        },

        computed: {
            event: function(){
                var e = this.ev;

                if(e.repeating){
                    e.date = intervalDisplay(this, e.start.date, e.repeating);
                }else{
                    var m = moment(e.start.date);

                    e.date = displayDay(this, m.weekday(), false);
                    e.date += ' '+m.format('D');
                    e.date += ' '+displayMonth(this, m.format('M'));
                    e.date += ' '+m.format('YYYY');

                }

                e.start = moment(e.start.date).format('HH:mm');
                e.end = moment(e.end.date).format('HH:mm');

                return e;
            }
        }

    })
});
