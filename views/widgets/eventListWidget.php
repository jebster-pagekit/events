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

    .jebster_event .jebster_image img{
        width: 56px;
        height: 56px;
        padding: 8px 0 0 1px;
    }

    .jebster_event .jebster_image span{
        position: absolute;
        left: 14px;
        top: 30px;
        font-size: 24px;
    }

    .jebster_event .jebster_image .one_digit{
        padding-left: 6px;
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
</style>

<div class="jebster_event_list">
    <h3>Schedule for the week</h3>
    <?php if(sizeof($events) <= 0): ?>
        <div><?= __('No future events') ?></div>
    <?php endif; ?>

    <?php foreach ($events as $event): ?>
        <div class="jebster_event">
            <div class="jebster_image">
                <span class="<?php if ($event->start->format('j') < 10) echo 'one_digit' ?>">
                    <?= $event->start->format('j') ?>
                </span>
                <img src="<?= $view->url()->getStatic('events:assets/vectors/5.svg') ?>">

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

