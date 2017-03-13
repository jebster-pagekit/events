<?php
$view->script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js');
$view->script('event', 'events:js/events-edit.js', ['vue', 'vue-router', 'VueRouter', 'editor', 'uikit', 'moment'])
?>

<div id="event" class="uk-form" v-cloak>
    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>
            <h2 class="uk-margin-remove" v-if="event.id">{{ 'Edit %eventTitle%' | trans {eventTitle: event.title} }}</h2>
            <h2 class="uk-margin-remove" v-else>{{ 'Add Event' | trans }}</h2>
        </div>

        <div id="delete-popup" class="uk-modal" >
            <div class="uk-modal-dialog">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h1>
                        {{ "Delete '%event%' ?" | trans {event:event.title} }}
                    </h1>
                </div>
                <p>
                    {{ "Are you sure you want to delete this event? You won't be able to recover it." | trans }}
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
    <ul class="uk-tab" v-el:tab>
        <li>
            <a>{{ 'General' | trans }}</a>
        </li>
        <li>
            <a>{{ 'Meta' | trans }}</a>
        </li>
    </ul>
    <div class="uk-switcher uk-margin" v-el:content>
        <div>
            <div class="uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked" data-uk-grid-margin>

                <div class="pk-width-content">
                    <div class="uk-form-row">
                        <label for="form-title" class="uk-form-label">{{ 'Title' | trans }}</label>
                        <div class="uk-form-controls">
                            <input id="form-title" class="uk-width-1-1" type="text"
                                   placeholder="{{ 'Enter Title' | trans }}" v-model="event.title">
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label for="form-short" class="uk-form-label">{{ 'Short description' | trans }}</label>
                        <div class="uk-form-controls">
                            <input id="form-short" class="uk-width-1-1" type="text"
                                   placeholder="{{ 'Enter a short description' | trans }}" v-model="event.short_description">
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label for="form-location" class="uk-form-label">{{ 'Location' | trans }}</label>
                        <div class="uk-form-controls">
                            <input id="form-location" class="uk-width-1-1" type="text" placeholder="{{ 'Enter Location' | trans }}" v-model="event.location" >
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label for="form-description" class="uk-form-label">{{ 'Description' | trans }}</label>
                        <div class="uk-form-controls">
                            <v-editor id="form-description" :value.sync="event.description" :options="{markdown : post.data.markdown, height: 250}"></v-editor>
                        </div>
                    </div>
                </div>

                <div class="pk-width-sidebar">
                    <div class="uk-form-row">
                        <label for="form-facebook" class="uk-form-label">{{ 'Image' | trans }}:</label>
                        <div class="uk-form-controls">
                            <input-image-meta :image.sync="event.data.image" class="pk-image-max-height"></input-image-meta>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label for="form-slug" class="uk-form-label">{{ 'Slug' | trans }}</label>
                        <div class="uk-form-controls">
                            <input id="form-slug" type="text" class="uk-width-1-1" placeholder="{{ 'Auto from title' | trans }}" v-model="event.slug">
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <span class="uk-form-label">{{ 'Start time' | trans }}:</span>
                        <div class="uk-form-controls">
                            <input-date :datetime.sync="event.start"></input-date>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <span class="uk-form-label">{{ 'End time' | trans }}:</span>
                        <div class="uk-form-controls">
                            <input-date :datetime.sync="event.end"></input-date>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <span class="uk-form-label">{{ 'Options' | trans }}</span>
                        <div class="uk-form-controls">
                            <label>
                                <input type="checkbox" v-model="event.active" value="1">
                                {{ 'Published' | trans }}
                            </label><br>
                            <label>
                                <input type="checkbox" v-model="event.data.fbcomments">
                                {{ 'Allow Facebook comments' | trans }}
                            </label><br>
                            <label v-show="repeat.show" :class="{'uk-text-muted': repeat.hasId}">
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

        <div>
            <div class="uk-form-horizontal" data-uk-grid-margin>

                <div class="uk-form-row">
                    <label for="og-title" class="uk-form-label">
                        {{ 'Title' | trans }}
                    </label>
                    <div class="uk-form-controls">
                        <input id="og-title" type="text" class="uk-form-width-large"
                               placeholder="{{ 'Enter Title' | trans }}" v-model="event.data.og.title">
                    </div>
                </div>

                <div class="uk-form-row">
                    <label for="og-description" class="uk-form-label">
                        {{ 'Description' | trans }}
                    </label>
                    <div class="uk-form-controls">
                        <textarea type="text" id="og-description" type="text" class="uk-form-width-large" rows="5"
                                  placeholder="{{ 'Enter description' | trans }}" v-model="event.data.og.description"></textarea>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label for="og-description" class="uk-form-label">
                        {{ 'Image' | trans }}
                    </label>
                    <div class="uk-form-controls uk-form-width-large">
                        <input-image-meta :image.sync="event.data.og.image" class="pk-image-max-height"></input-image-meta>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>