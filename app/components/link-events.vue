<template>
    <div class="uk-form-row">
        <label for="form-link-events" class="uk-form-label">{{ 'Events' | trans }}</label>
        <div class="uk-form-controls">
            <select id="form-link-events" class="uk-width-1-1" v-model="selected">
                <option value="0" style="font-weight: bold" selected>{{ 'Calender view' | trans }}</option>
                <option v-for="event in events" :value="event.id">{{ event.title }}</option>
            </select>
        </div>
    </div>
</template>

<script>

    module.exports = {

        link: {
            label: 'Events'
        },

        props: ['link'],

        data() {
            return {
                events: [{id:0, title:'Loading...'}],
                selected: ''
            }
        },

        created() {
            this.$resource('api/event/form').get().then(res => this.events = res.data);
        },

        watch: {
            selected(selected) {
                if(selected && selected > 0)
                    this.link = 'events/' + this.events[selected].slug;
                else
                    this.link = 'events';
            }
        }

    };

    window.Links.components['events'] = module.exports;

</script>
