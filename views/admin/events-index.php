<?php
$view->script('utils', 'events:js/utils.js');
$view->script('moment', 'events:assets/js/libraries/moment.min.js');
$view->script('events', 'events:js/events-index.js', ['vue', 'moment', 'utils']);
?>

<div id="events" class="uk-form" v-cloak>

    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="pk-width-sidebar">

            <div class="uk-panel">

                <ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
                    <li>
                        <a>
                            <i class="uk-icon-file-o" style="font-size: 20px"></i>
                            {{ 'Events' | trans }}
                        </a>
                    </li>
                    <li>
                        <a>
                            <i class="uk-icon-files-o" style="font-size: 20px"></i>
                            {{ 'Repeating events' | trans }}
                        </a>
                    </li>
                </ul>

            </div>

        </div>
        <div class="pk-width-content">
            <ul id="tab-content" class="uk-switcher uk-margin">
                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

                            <h2 class="uk-margin-remove" v-if="!events_selected.length">
                                {{ '{0} %count% Events|{1} %count% Event|]1,Inf[ %count% Events' | transChoice events_count {count:events_count} }}
                            </h2>

                            <template v-else>
                                <h2 class="uk-margin-remove">{{ '{1} %count% Event selected|]1,Inf[ %count% Events selected' | transChoice events_selected.length {count:events_selected.length} }}</h2>

                                <div class="uk-margin-left" >
                                    <ul class="uk-subnav pk-subnav-icon">
                                        <li><a class="pk-icon-check pk-icon-hover" title="Publish" data-uk-tooltip="{delay: 500}" @click="status(true,'events')"></a></li>
                                        <li><a class="pk-icon-block pk-icon-hover" title="Unpublish" data-uk-tooltip="{delay: 500}" @click="status(false, 'events')"></a></li>
                                        <li><a class="pk-icon-delete pk-icon-hover" title="Delete" data-uk-tooltip="{delay: 500}" @click="remove('events')" v-confirm="$trans('Delete Events?')"></a></li>
                                    </ul>
                                </div>
                            </template>

                            <div class="pk-search">
                                <div class="uk-search">
                                    <input class="uk-search-field" type="text" v-model="events_config.filter.search" debounce="300">
                                </div>
                            </div>

                        </div>
                        <div data-uk-margin>

                            <a class="uk-button uk-button-primary" :href="$url.route('admin/events/edit')">{{ 'Add Event' | trans }}</a>

                        </div>
                    </div>

                    <div class="uk-overflow-container">
                        <table class="uk-table">
                            <thead>
                                <tr>
                                    <th class="pk-table-width-minimum">
                                        <input type="checkbox" v-check-all:events_selected.literal="input[name=event_id]" number>
                                    </th>
                                    <th class="pk-table-min-width-300" v-order:title="events_config.filter.order">
                                        {{ 'Title' | trans }}
                                    </th>
                                    <th class="pk-table-width uk-text-center">
                                        <input-filter :title="$trans('Status')" :value.sync="events_config.filter.active" :options="statusOptions"></input-filter>
                                    </th>
                                    <th v-order:location="events_config.filter.order">
                                        {{ 'Location' | trans }}
                                    </th>
                                    <th>
                                        {{ 'Start time' | trans }}
                                    </th>
                                    <th>
                                        {{ 'End time' | trans }}
                                    </th>
                                    <th v-order:start="events_config.filter.order">
                                        {{ 'Date' | trans }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="event in events">
                                    <td>
                                        <input type="checkbox" name="event_id" :value="event.id">
                                    </td>
                                    <td>
                                        <a :href="$url.route('admin/events/edit/'+event.id)">
                                            {{ event.title }}
                                        </a>
                                    </td>
                                    <td class="uk-text-center">
                                        <a :class="{
                                            'pk-icon-circle-danger': !event.active,
                                            'pk-icon-circle-success': event.active
                                            }" @click="toggleStatus(event)"></a>
                                    </td>
                                    <td>
                                        {{ event.location }}
                                    </td>
                                    <td>
                                        {{ event.start | hourMinute }}
                                    </td>
                                    <td>
                                        {{ event.end | hourMinute }}
                                    </td>
                                    <td>
                                        {{ event.start | date }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3 class="uk-h1 uk-text-muted uk-text-center" v-show="events && !events.length">{{ 'No events found.' | trans }}</h3>

                    <v-pagination :page.sync="events_config.page" :pages="events_pages" v-show="events_pages > 1 || page > 0"></v-pagination>
                </li>

                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

                            <h2 class="uk-margin-remove" v-if="!repeating_selected.length">
                                {{ '{0} %rcount% Events|{1} %rcount% Event|]1,Inf[ %rcount% Events' | transChoice repeating_count {rcount:repeating_count} }}
                            </h2>

                            <template v-else>
                                <h2 class="uk-margin-remove">{{ '{1} %count% Event selected|]1,Inf[ %count% Events selected' | transChoice repeating_selected.length {count:repeating_selected.length} }}</h2>

                                <div class="uk-margin-left" >
                                    <ul class="uk-subnav pk-subnav-icon">
                                        <li><a class="pk-icon-check pk-icon-hover" title="Publish" data-uk-tooltip="{delay: 500}" @click="status(true,'repeating')"></a></li>
                                        <li><a class="pk-icon-block pk-icon-hover" title="Unpublish" data-uk-tooltip="{delay: 500}" @click="status(false, 'repeating')"></a></li>
                                        <li><a class="pk-icon-delete pk-icon-hover" title="Delete" data-uk-tooltip="{delay: 500}" @click="remove('repeating')" v-confirm="$trans('Delete Events?')"></a></li>
                                    </ul>
                                </div>
                            </template>

                            <div class="pk-search">
                                <div class="uk-search">
                                    <input class="uk-search-field" type="text" v-model="repeating_config.filter.search" debounce="300">
                                </div>
                            </div>

                        </div>
                        <div data-uk-margin>

                            <a class="uk-button uk-button-primary" :href="$url.route('admin/events/edit')">{{ 'Add Event' | trans }}</a>

                        </div>
                    </div>

                    <table class="uk-table">
                        <thead>
                            <tr>
                                <th class="pk-table-width-minimum">
                                    <input type="checkbox" v-check-all:repeating_selected.literal="input[name=repeating_id]" number>
                                </th>
                                <th class="pk-table-min-width-300" v-order:title="repeating_config.filter.order">
                                    {{ 'Title' | trans }}
                                </th>
                                <th class="pk-table-width uk-text-center">
                                    <input-filter :title="$trans('Status')" :value.sync="repeating_config.filter.active" :options="statusOptions"></input-filter>
                                </th>
                                <th v-order:location="repeating_config.filter.order">
                                    {{ 'Location' | trans }}
                                </th>
                                <th>
                                    {{ 'Start time' | trans }}
                                </th>
                                <th>
                                    {{ 'End time' | trans }}
                                </th>
                                <th>
                                    {{ 'Interval' | trans }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="event in repeatingEvents">
                                <td>
                                    <input type="checkbox" name="repeating_id" :value="event.id">
                                </td>
                                <td>
                                    <a :href="$url.route('admin/events/edit/'+event.id)">
                                        {{ event.title }}
                                    </a>
                                </td>
                                <td>
                                    <a :class="{
                                        'pk-icon-circle-danger': !event.active,
                                        'pk-icon-circle-success': event.active
                                        }" @click="toggleStatus(event)"></a>
                                </td>
                                <td>
                                    {{ event.location }}
                                </td>
                                <td>
                                    {{ event.start | hourMinute }}
                                </td>
                                <td>
                                    {{ event.end | hourMinute }}
                                </td>
                                <td>
                                    {{ event | interval }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>
    </div>


</div>
