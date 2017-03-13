<?php
$view->script('moment', 'events:assets/js/libraries/moment.min.js');
$view->script('utils', 'events:js/utils.js', 'vue');
$view->script('event', 'events:js/frontend/event.js', ['vue', 'moment', 'utils']);

$view->style('font-awesome', 'events:assets/css/libraries/font-awesome.min.css');

$url = 'http://'.$_SERVER['HTTP_HOST'].'/events/'.$event->id;


$size = (($image = $event->get('image')) && strlen($image['src']) > 1) ? 8 : 12;

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fo_FO/all.js#xfbml=1"; // &appId=
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div id="event">
<br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3">
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ event.title }}
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class=" col-md-<?= $size ?> col-lg-<?= $size ?> ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>{{ 'Title' | trans}}</td>
                                <td>{{ event.title }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Date' | trans }}</td>
                                <td>{{ event.date }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Location' | trans }}</td>
                                <td>{{ event.location }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Event starts' | trans }}</td>
                                <td>{{ event.start }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Event ends' | trans }}</td>
                                <td>{{ event.end }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{{{ event.description }}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php if($size != 12): ?>
                    <div class="col-md-4 col-lg-4 " align="center">
                        <img alt="<?php $image['alt'] ?>" src="<?= Pagekit\Application::url()->getStatic($image['src'], [], 0) ?>" class="img-responsive"><br><br>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php if($event->get('fbcomments')): ?>
                <div class="panel-footer">
                    <div class="fb-like pull-right-only" data-href="<?= $url ?>" data-width="320" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <br>
                    <div class="fb-comments" data-href="<?= $url ?>" data-width="480" data-num-posts="10">Comments</div>
                    <br><br>
                </div>
            <?php endif; ?>
        </div>
    </div>


</div>
