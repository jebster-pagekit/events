<?php
$view->script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js');
$view->script('moment-recur', 'events:assets/js/moment-recur.min.js', 'moment');
$view->script('utils', 'events:js/utils.js');
$view->script('events', 'events:js/events-index.js', ['moment', 'moment-recur', 'vue', 'utils']);
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
                        <div data-uk-margin>
                            <h2 class="uk-margin-remove">{{ 'Events' | trans }}</h2>
                        </div>

                        <div data-uk-margin>
                            <a class="uk-button uk-button-primary" :href="$url.route('admin/events/edit')">{{ 'Add Event' | trans }}</a>
                        </div>
                    </div>


                    <table class="uk-table">
                        <thead>
                            <tr>
                                <th class="pk-table-min-width-300">
                                    {{ 'Title' | trans }}
                                </th>
                                <th>
                                    {{ 'Status' | trans }}
                                </th>
                                <th>
                                    {{ 'Location' | trans }}
                                </th>
                                <th>
                                    {{ 'Start time' | trans }}
                                </th>
                                <th>
                                    {{ 'End time' | trans }}
                                </th>
                                <th>
                                    {{ 'Date' | trans }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="event in events">
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
                                    {{ event.start }}
                                </td>
                                <td>
                                    {{ event.end }}
                                </td>
                                <td>
                                    {{ event.date }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>

                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div data-uk-margin>
                            <h2 class="uk-margin-remove">{{ 'Repeating Events' | trans }}</h2>
                        </div>

                        <div data-uk-margin>
                            <a class="uk-button uk-button-primary" :href="$url.route('admin/events/edit')">
                                {{ 'Add Event' | trans }}
                            </a>
                        </div>
                    </div>

                    <table class="uk-table">
                        <thead>
                            <tr>
                                <th class="pk-table-min-width-300">
                                    {{ 'Title' | trans }}
                                </th>
                                <th>
                                    {{ 'Status' | trans }}
                                </th>
                                <th>
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
                                    {{ event.start }}
                                </td>
                                <td>
                                    {{ event.end }}
                                </td>
                                <td>
                                    {{ event.interval }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>
    </div>


</div>
