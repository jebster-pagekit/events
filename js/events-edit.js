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
            console.log(moment(this.event.start.date).format('YYYY-MM-DD [at] TT tt hh:mm'));
            // this.event.start = this.event.start.date;
            // this.event.end = this.event.end.date;
            this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content});
        },

        methods: {
            save: function(){
                this.event.repeating = this.repeat.repeating ? this.repeat.interval : null;
                this.$http.post('admin/events/save', { event: this.event }, function(event) {
                    UIkit.notify(vm.$trans('Saved'), '');
                    // if(!this.event.id)
                    //     this.redirect('edit/'+event.event.id);
                    this.event = event.event;
                }).error(function(data) {
                    UIkit.notify(data, 'danger');
                    this.event.id = null;
                });
            },

            delete: function(){
                this.$http.post('admin/events/delete', {id: this.event.id }, function () {
                    UIkit.notify(vm.$trans('Deleted'));
                    this.redirect('events');
                }).error(function(data){
                    UIkit.notify(data, 'danger');
                });
            },

            redirect: function(path){
                location.href = '/admin/events/'+path;
            }
        }
    });
});