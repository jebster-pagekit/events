$(function(){

    var vm = new Vue({
        el: '#event',

        data: {
            event: window.$data.event,
            repeat: {
                show: true,
                hasId: window.$data.event.id,
                repeating: window.$data.event.repeating != null,
                interval: window.$data.event.repeating == null ? 7 : window.$data.event.repeating
            },
            sections: []
        },

        ready: function () {
            console.log(this.repeat.repeating);
            this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content});
        },

        methods: {
            save: function(){
                this.event.repeating = this.repeat.interval;
                this.$http.post('admin/events/save', { event: this.event }, function(event) {
                    console.log(event);
                    UIkit.notify(vm.$trans('Saved.'), '');
                }).error(function(data) {
                    UIkit.notify(data, 'danger');
                });
            }
        }
    });
});