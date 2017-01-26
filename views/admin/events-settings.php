<?php $view->script('settings', 'events:js/events-settings.js', ['vue', 'editor', 'uikit']) ?>

<div id="settings" class="uk-form uk-form-horizontal" v-cloak>
    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="pk-width-sidebar">

            <div class="uk-panel">

                <ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
                    <li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'General' | trans }}</a></li>
<!--                    <li><a><i class="pk-icon-large-cone uk-icon-small uk-margin-right"></i> {{ 'More' | trans }}</a></li>-->
                </ul>

            </div>

        </div>
        <div class="pk-width-content">

            <ul id="tab-content" class="uk-switcher uk-margin">
                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div data-uk-margin>
                            <h2 class="uk-margin-remove">{{ 'General' | trans }}</h2>
                        </div>

                        <div data-uk-margin>
                            <button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}</button>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Max events in list' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="number" v-model="settings.max" class="uk-form-width-small">
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <h1>{{ 'No more settings at the moment' | trans}}</h1>
                </li>
            </ul>
        </div>
    </div>

</div>
