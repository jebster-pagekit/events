$(function(){
    var vm = new Vue({
        el: '#settings',

        data: {
            settings: window.$data.settings
        },

        methods: {
            save: function () {
                this.$http.post('/admin/events/updatemax', { max: this.settings.max }, function() {
                    UIkit.notify(vm.$trans('Saved.'), '');
                }).error(function(data) {
                    UIkit.notify(data, 'danger');
                });
            }
        }
    });
});