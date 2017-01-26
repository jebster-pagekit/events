$(function(){
    var vm = new Vue({
        el: '#events',

        data: {
            events: window.$data.events,
            newEntry: ''
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
            }
        }
    });
});