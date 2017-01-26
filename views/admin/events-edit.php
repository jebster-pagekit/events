<?php $view->script('event', 'events:js/events-edit.js', ['vue', 'editor', 'uikit']) ?>

<div id="event" class="uk-form" v-cloak>
    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>

            <h2 class="uk-margin-remove" v-if="event.id">{{ 'Edit %event%' | trans {event: event.title} }}</h2>
            <h2 class="uk-margin-remove" v-else>{{ 'Add Event' | trans }}</h2>

        </div>
        <div data-uk-margin>

            <a class="uk-button uk-margin-small-right" :href="$url.route('admin/events/events')">
                {{ event ? 'Close' : 'Cancel' | trans }}
            </a>
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
                    <label><input type="checkbox" v-model="event.active" value="1"> {{ 'Published' | trans }}</label>
                </div>
            </div>
        </div>

    </div>
</div>