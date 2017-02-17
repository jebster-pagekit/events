$(function(){
    var vm = new Vue({
        el: '#events',

        data: {
            events: [],
            repeatingEvents: [],
            // ev: window.$data.events,
            // rev: window.$data.repeating,

            events_pages: 0,
            events_config: {filter: {order: 'date desc', limit: 15}},
            events_selected: [],
            events_count : '',

            repeating_pages: 0,
            repeating_config: {filter: {order: 'date desc', limit: 15}},
            repeating_selected: [],
            repeating_count : ''
            // config: _.merge({
            //     events_page: 0,
            //     repeating_page: 0,
            //     events_filter: {order: 'date desc', limit: 2}, //this.$session.get('events.events_filter', {order: 'date desc', limit:2}),
            //     repeating_filter: {order: 'date desc', limit: 2}, //this.$session.get('event.repeating_filter', {order: 'date desc', limit:2}),
            //     events_selected: [],
            //     repeating_selected: [],
            //     events_count: '',
            //     repeating_count: ''
            // },window.$data.config)
        },

        ready: function () {
            this.resource = this.$resource('api/event{/id}');

            this.$watch('events_config.page', this.loadEvents, {immediate: true});
            this.$watch('repeating_config._page', this.loadRepeating, {immediate: true});

        },

        computed: {
            statusOptions: function () {
                var options = _.map(window.$data.statuses, function (status, id) {
                    return { text: status, value: id };
                });

                return [{ label: this.$trans('Filter by'), options: options }];
            },
        },

        watch: {
            'events_config.filter': {
                handler: function(filter){
                    this.loadEvents();
                    this.$session.set('events.events_filter', filter);
                }, deep: true
            },
            'repeating_config.filter': {
                handler: function (filter) {
                    this.loadRepeating();
                    this.$session.set('events.repeating_filter', filter);
                }, deep: true
            }
        },

        methods: {
            // add: function(e) {
            //     e.preventDefault();
            //     alert('Delete this if you have never seen this message! and newEntry');
            //     if(!this.newEntry) return;
            //
            //     var entry = {
            //         message: this.newEntry,
            //         done: false
            //     };
            //
            //     this.events.push(entry);
            //
            //     this.save(entry);
            //
            //     this.newEntry = '';
            // },

            remove: function(type) {
                this.resource.delete({ id: 'bulk' }, { ids: this[type+'_selected']}).then(function () {
                    this['load'+type.charAt(0).toUpperCase() + type.slice(1)]();
                    this.$notify(vm.$trans('Events deleted.'));
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
            },

            getSelected: function(type) {
                var dataType = type == 'events' ? 'events' : type+'Events';
                return this[dataType].filter(function(event) { return this[type+'_selected'].indexOf(event.id) !== -1; }, this);
            },

            status: function(status, type) {
                var events = this.getSelected(type);

                events.forEach(function(event) {
                    event.active = status;
                });

                this.resource.save({ id: 'bulk' }, {events: events}).then(function () {
                    this['load'+type.charAt(0).toUpperCase() + type.slice(1)]();
                    this.$notify('Events saved');
                });
            },

            // Load
            loadEvents: function () {
                this.resource.query({id:"events", filter:this.events_config.filter, page: this.events_config.page}).then(function (res) {
                    if(res.status == 200){
                        this.events = res.data.events;
                        this.events_pages = res.data.pages;
                        this.events_count = res.data.count;
                        this.events_selected = [];
                    }else{
                        UIkit.notify(vm.$trans('Something went terribly wrong'), 'danger');
                    }
                });
            },

            loadRepeating: function () {
                this.resource.query({id:"repeating",filter:this.repeating_config.filter, page:this.repeating_page}).then(function (res) {
                    if(res.status == 200){
                        this.repeatingEvents = res.data.events;
                        this.repeating_pages = res.data.pages;
                        this.repeating_count = res.data.count;
                        this.repeating_selected = [];
                    }else{
                        UIkit.notify(vm.$trans('Something went terribly wrong'), 'danger');
                    }
                });
            }
        }
    });

    Vue.filter('hourMinute', function (value) {
        return moment(value).format("HH:mm");
    });

    Vue.filter('interval', function (event) {
        return intervalDisplay(this, event.start, event.repeating);
    })
});
