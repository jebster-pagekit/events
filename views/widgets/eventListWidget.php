<?php
use Pagekit\Application as App;

$module = App::module('events');
$config = $module->config;
$max = $config['settings']['max'];
$counter = 0;
?>
<style>
    .jebster_event_list{
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
        border-right: 1px solid #000;
    }

    .jebster_event{
        padding: 6px;
        text-align: center;
    }

    .jebster_event .jebster_image{
        float: left;
        width: 52px;
        height: 52px;
        margin: 5px;
        background-color: #77B3D4;
        border-radius: 90px;
    }

    .jebster_event .jebster_image img{
        width: 42px;
        height: 42px;
        padding-top: 8px;
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
    <?php if(sizeof($events) <= 0): ?>
        <div><?= __('No future events') ?></div>
    <?php endif; ?>

    <?php foreach ($events as $event): if($event->active && $counter < $max): $counter++; ?>
        <div class="jebster_event">
            <div class="jebster_image">
                <img src="<?= $view->url()->getStatic('events:assets/vectors/5.svg') ?>">
            </div>
            <p class="jebster_event_title">
                <?= $event->title ?> -
                <?= __('%hourMinute%', ['%hourMinute%' => $event->start->format('h:i')]) ?>
            </p>
            <p class="jebster_event_description clearfix">
                <?= __('at %location%', ['%location%' => $event->location]) ?>
            </p>
        </div>
    <?php endif; endforeach; ?>
</div>

