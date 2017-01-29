<?php
$view->script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js');
$view->script('events', 'events:js/events-index.js', ['moment', 'vue'])
?>

<div id="events" class="uk-form" v-cloak>

    <a class="uk-button uk-button-primary" :href="$url.route('admin/events/edit')">{{ 'Add Event' | trans }}</a>

    <table class="uk-table">
        <tr>
            <th>
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
        </tr>
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
        </tr>
    </table>

</div>
