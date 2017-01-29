$(function(){
    var vm = new Vue({
        el: '#events',

        data: {
            ev: window.$data.events,
            newEntry: ''
        },

        computed: {
            events: function () {
                var e = [];
                for(var i = 0; i < this.ev.length; i++){
                    this.ev[i].start = moment(this.ev[i].start.date).format("DD/MM-YY - HH:mm");
                    e.push(this.ev[i]);
                }
                return e;
            }
        },

        methods: {
            add: function(e) {
                e.preventDefault();

                if(!this.newEntry) return;

                var entry = {
                    message: this.newEntry,
                    done: false
                };

                this.events.push(entry);

                this.save(entry);

                this.newEntry = '';
            },

            remove: function(entry) {
                this.events.$remove(entry);
                this.$http.post('admin/events/delete', {id: entry.id}, function(data){
                    UIkit.notify(vm.$trans('Deleted.'), '');
                }).error(function (data) {
                    UIkit.notify(vm.$trans('Something went wrong, please contact support.'), 'danger');
                    this.events.push(entry);
                });
            },

            save: function(entry){
                this.$http.post('admin/events/save', {entry: entry}, function(data){
                    UIkit.notify(vm.$trans('Saved.'), '');
                    entry.id = data.event.id;
                }).error(function (data) {
                    UIkit.notify(data, 'danger');
                });
            },

            toggleStatus: function(event){
                event.active = !event.active;

                this.$http.post('admin/events/togglestatus', {id: event.id}, function(data){

                }).error(function (data) {
                    UIkit.notify(data, 'danger');
                    event.active = !event.active;
                });
            }
        }
    });
});