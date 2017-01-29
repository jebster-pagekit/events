<?php $view->script('event', 'events:js/events-edit.js', ['vue', 'vue-router', 'VueRouter', 'editor', 'uikit']) ?>

<div id="event" class="uk-form" v-cloak>
    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>

            <h2 class="uk-margin-remove" v-if="event.id">{{ 'Edit %event%' | trans {event: event.title} }}</h2>
            <h2 class="uk-margin-remove" v-else>{{ 'Add Event' | trans }}</h2>

        </div>


        <div id="delete-popup" class="uk-modal" >
            <div class="uk-modal-dialog">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h1>
                        {{ 'Delete \'%event%\' ?' | trans {'event':event.title} }}
                    </h1>
                </div>
                <p>
                    {{ 'Are you sure you want to delete this event? You won\'t be able to recover it.' | trans }}
                </p>
                <div class="uk-modal-footer uk-text-right">
<!--                    <button class="uk-button uk-button-primary">-->
<!--                        {{ 'Close' | trans }}-->
<!--                    </button>-->
                    <button class="uk-button uk-button-danger" @click="delete">
                        {{ 'Delete' | trans }}
                    </button>
                </div>
            </div>
        </div>

        <div data-uk-margin>
            <a class="uk-button uk-margin-small-right" :href="$url.route('admin/events/events')">
                {{ event ? 'Close' : 'Cancel' | trans }}
            </a>
            <button class="uk-button uk-button-danger" v-show="event.id" data-uk-modal="{target:'#delete-popup', center:true}">
                {{ 'Delete' | trans }}
            </button>
            <button class="uk-button uk-button-primary" @click="save">
                {{ 'Save' | trans }}
            </button>

        </div>
    </div>

    <div class="uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked" data-uk-grid-margin>


        <div class="pk-width-content">
            <div class="uk-form-row">
                <label for="form-slug" class="uk-form-label">{{ 'Title' | trans }}</label>
                <div class="uk-form-controls">
                    <input id="form-title" class="uk-width-1-1" type="text"
                           placeholder="{{ 'Enter Title' | trans }}" v-model="event.title">
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-slug" class="uk-form-label">{{ 'Location' | trans }}</label>
                <div class="uk-form-controls">
                    <input id="location" class="uk-width-1-1" type="text" placeholder="{{ 'Enter Location' | trans }}" v-model="event.location" >
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-post-excerpt" class="uk-form-label">{{ 'Description' | trans }}</label>
                <div class="uk-form-controls">
                    <v-editor id="form-description" :value.sync="event.description" :options="{markdown : post.data.markdown, height: 250}"></v-editor>
                </div>
            </div>
        </div>

        <div class="pk-width-sidebar">
            <div class="uk-form-row">
                <label for="form-slug" class="uk-form-label">{{ 'Facebook event link' | trans }}:</label>
                <div class="uk-form-controls">
                    <input id="location" class="uk-width-1-1" type="text" v-model="event.fb_event">
                </div>
            </div>

            <div class="uk-form-row">
                <span class="uk-form-label">{{ 'Start time' | trans }}:</span>
                <div class="uk-form-controls">
                    <input-date :datetime.sync="event.start.date"></input-date>
                </div>
            </div>

            <div class="uk-form-row">
                <span class="uk-form-label">{{ 'End time' | trans }}:</span>
                <div class="uk-form-controls">
                    <input-date :datetime.sync="event.end.date"></input-date>
                </div>
            </div>

            <div class="uk-form-row">
                <span class="uk-form-label">{{ 'Options' | trans }}</span>
                <div class="uk-form-controls">
                    <label>
                        <input type="checkbox" v-model="event.active" value="1">
                        {{ 'Published' | trans }}
                    </label><br>
                    <label v-show="repeat.show" v-bind:class="{'uk-text-muted': repeat.hasId}">
                        <input type="checkbox" v-model="repeat.repeating" :disabled="repeat.hasId" value="1">
                        {{ 'Repeating event' | trans }}
                    </label>
                </div>
            </div>

            <div class="uk-form-row" v-show="repeat.repeating">
                <span class="uk-form-label">{{ 'Every number of days' | trans }}</span>
                <input id="location" class="uk-width-1-1" type="number" min="1" v-model="repeat.interval">
            </div>
        </div>

    </div>
</div>