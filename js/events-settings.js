$(function(){
    var vm = new Vue({
        el: '#settings',

        data: {
            settings: window.$data.settings,
            frontEndStyleOptions: ['UIKit','Bootstrap'],
        },

        methods: {
            save: function () {
                this.$http.post('/admin/events/updatesettings', {settings: this.settings}, function () {
                    UIkit.notify(vm.$trans('Saved.'), '');
                }).error(function(data) {
                    UIkit.notify(data, 'danger');
                });
            }
        }
    });
});