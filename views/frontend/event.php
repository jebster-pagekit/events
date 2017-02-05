<?php
$view->script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js');
$view->script('utils', 'events:js/utils.js', 'vue');
$view->script('event', 'events:js/event-frontend.js', ['vue', 'moment', 'utils'])
?>
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
                    <div class=" col-md-8 col-lg-8 ">
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
                                <td>{{ 'Event starts' | trans }}</td>
                                <td>{{ event.start }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Event ends' | trans }}</td>
                                <td>{{ event.end }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{{ event.description }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4 col-lg-4 " align="center">
                        <img alt="User Pic" src="http://i2.cdn.cnn.com/cnnnext/dam/assets/161127012658-google-maps-dump-tower-large-169.jpg" class="img-responsive">
                    </div>

                </div>
            </div>
            <div class="panel-footer">
                <a class="btn btn-sm btn-primary pull-right" data-original-title="Broadcast Message" data-toggle="tooltip" type="button">
                    <i class="glyphicon glyphicon-share-alt"></i>
                </a>
                Facebook Comments?
                <br><br>
            </div>
        </div>
    </div>


</div>
