<?php
$testb = 'Trying';

echo "<script>var testb = ".json_encode($events).";</script>";

$view->script('utils', 'events:js/utils.js', 'vue');
$view->script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js');
$view->script('eventList', 'events:js/eventListWidget.js', ['utils', 'vue', 'moment']);

?>


<style>
    .jebster_event_list{

    }

    .jebster_event{
        padding: 6px;
        text-align: center;
        height: 80px;
    }

    .jebster_event .jebster_image{
        position: relative;
        float: left;
        width: 56px;
        height: 56px;
    }

    .jebster_calendar_icon{
        width: 58px;
        height: 58px;
        border: 5px solid #BA0000;
        border-radius: 10px;
        margin: 4px 0 0 2px;
    }

    .jebster_calendar_icon::before{
        position: absolute;
        border: 5px solid #BA0000;
        border-radius: 10px 10px 0 0;
        background-color: #BA0000;
        height: 18px;
        width: 58px;
        top: 4px;
        left: 2px;
        content: ' ';
    }

    .jebster_event_title{
        margin: 3px 0 0 0;
        font-size: 16px;
        text-align: center;
    }

    .jebster_event_description{
        font-size: 12px;
        font-style: italic;
        line-height:12px;
        text-align: center;
    }

    .jebster_event_shortdescription{
        font-size: 12px;
        line-height: 22px;
        text-align: center;
        margin-bottom: 2px;
    }

    .jebster_event:nth-child(even){
        background-color: #fff;
    }

    .jebster_event:nth-child(odd){
        background-color: #f1f1f1;
    }

    span.jebster_month{
        position: absolute;
        top: 5px;
        left: 20px;
        color: white;
        font-size: 13px;
        font-weight:bold;
    }

    span.jebster_dayNumber{
        position: absolute;
        top: 28px;
        left: 20px;
        font-size: 18px;
        font-weight:bold;
    }

    span.jebster_dayName{
        position: absolute;
        top: 42px;
        left: 21px;
        font-size: 12px;
    }

    span.jebster_onedigit{
        left: 26px;
    }

    .jebster_event_link{
        color: black;
        text-decoration: none;
    }

    .jebster_event_link:hover{
        text-decoration: none;
    }

</style>

<div id="eventList" class="jebster_event_list">
    <h3 style="text-align: center;"><a href="events" class="jebster_event_link">
            {{ 'Schedule for the week' | trans }}
        </a></h3>

    <?php

    if(sizeof($events) <= 0): ?>
        <div><?= __('No future events') ?></div>
    <?php endif; ?>
    <div class="jebster_event" v-for="event in events">
        <a href="events/{{event.id}}" class="jebster_event_link">
            <div class="jebster_image">
                <div class="jebster_calendar_icon"></div>
                <span class="jebster_month">
                    {{ event.month }}
                </span>
                <span class="jebster_dayNumber" :class="{'jebster_onedigit': event.day_number < 10}">
                    {{ event.day_number }}
                </span>
                <span class="jebster_dayName">
                    {{ event.day_name }}
                </span>
            </div>
            <div style="margin: 0 0 0 62px;">
                <p class="jebster_event_title">
                        {{ event.title }} -
                        {{ event.time_interval }}
                </p>
                <p class="jebster_event_shortdescription">
                    &nbsp;{{ event.short_description }}&nbsp;
                </p>
                <p class="jebster_event_description clearfix">
                    {{ 'at %location%' | trans {location: event.location} }}
                </p>
            </div>
        </a>
    </div>

</div>

