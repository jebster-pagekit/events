<?php

function displayMonth($month, $abbr = false){
    if($abbr){
        switch ($month) {
            case 1:
                return __('Jan');
            case 2:
                return __('Feb');
            case 3:
                return __('Mar');
            case 4:
                return __('Apr');
            case 5:
                return __('May');
            case 6:
                return __('Jun');
            case 7:
                return __('Jul');
            case 8:
                return __('Aug');
            case 9:
                return __('Sep');
            case 10:
                return __('Oct');
            case 11:
                return __('Nov');
            case 12:
                return __('Dec');
        }
    }else{
        switch ($month) {
            case 1:
                return __('January');
            case 2:
                return __('February');
            case 3:
                return __('March');
            case 4:
                return __('April');
            case 5:
                return __('May');
            case 6:
                return __('June');
            case 7:
                return __('July');
            case 8:
                return __('August');
            case 9:
                return __('September');
            case 10:
                return __('October');
            case 11:
                return __('November');
            case 12:
                return __('December');
        }
    }
    return '';
}

function displayDay($day, $abbr = false){
    if($abbr){
        switch ($day) {
            case 1:
                return __('Mon');
            case 2:
                return __('Tue');
            case 3:
                return __('Wed');
            case 4:
                return __('Thu');
            case 5:
                return __('Fri');
            case 6:
                return __('Sat');
            case 7:
                return __('Sun');
        }
    }else{
        switch ($day) {
            case 1:
                return __('Monday');
            case 2:
                return __('Tuesday');
            case 3:
                return __('Wednesday');
            case 4:
                return __('Thursday');
            case 5:
                return __('Friday');
            case 6:
                return __('Saturday');
            case 7:
                return __('Sunday');
        }
    }
    return '';
}

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

    .jebster_event .jebster_image .jebster_calendar_icon{
        width: 62px;
        height: 62px;
        background-color: #BA0000;
        -webkit-mask-repeat: no-repeat;
        -webkit-mask-size: 58px;
        margin: 4px 0 0 2px;
    }

    .jebster_event_title{
        margin: 10px 0 0 0;
        font-size: 16px;
    }

    .jebster_event_description{
        font-size: 12px;
        font-style: italic;
        line-height:12px;
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

</style>

<div class="jebster_event_list">
    <h3>Schedule for the week</h3>
    <?php if(sizeof($events) <= 0): ?>
        <div><?= __('No future events') ?></div>
    <?php endif; ?>

    <?php foreach ($events as $event): ?>
        <div class="jebster_event">
            <div class="jebster_image">
                <!-- TODO: just use css instead of image -->
                <div class="jebster_calendar_icon" style="
                        -webkit-mask-image: url('<?= $view->url()->getStatic('events:assets/images/test.png') ?>');">
                </div>
                <span class="jebster_month">
                    <?= displayMonth($event->start->format('n'), true) ?>
                </span>
                <span class="jebster_dayNumber <?= $event->start->format('j') < 10 ? 'jebster_onedigit' : '' ?>">
                    <?= $event->start->format('j') ?>
                </span>
                <span class="jebster_dayName">
                    <?= displayDay($event->start->format('N'), true) ?>
                </span>
            </div>

            <p class="jebster_event_title">
                <?= $event->title ?> -
                <?= __('%hour%:%minute%', ['%hour%:%minute%' => $event->start->format('H:i')]) ?>
            </p>
            <p class="jebster_event_description clearfix">
                <?= __('at %location%', ['%location%' => $event->location]) ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>

