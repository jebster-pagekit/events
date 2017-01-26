$(function(){

    var vm = new Vue({
        el: '#event',

        data: {
            event: window.$data.event,
            sections: []
        },

        ready: function () {
            this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content});
        },

        methods: {
            save: function(){
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