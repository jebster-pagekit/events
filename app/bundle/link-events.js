/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	var __vue_script__, __vue_template__
	var __vue_styles__ = {}
	__vue_script__ = __webpack_require__(1)
	if (Object.keys(__vue_script__).some(function (key) { return key !== "default" && key !== "__esModule" })) {
	  console.warn("[vue-loader] packages/jebster/events/app/components/link-events.vue: named exports in *.vue files are ignored.")}
	__vue_template__ = __webpack_require__(2)
	module.exports = __vue_script__ || {}
	if (module.exports.__esModule) module.exports = module.exports.default
	var __vue_options__ = typeof module.exports === "function" ? (module.exports.options || (module.exports.options = {})) : module.exports
	if (__vue_template__) {
	__vue_options__.template = __vue_template__
	}
	if (!__vue_options__.computed) __vue_options__.computed = {}
	Object.keys(__vue_styles__).forEach(function (key) {
	var module = __vue_styles__[key]
	__vue_options__.computed[key] = function () { return module }
	})
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  var id = "_v-4faeef00/link-events.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ },
/* 1 */
/***/ function(module, exports) {

	'use strict';

	module.exports = {

	    link: {
	        label: 'Events'
	    },

	    props: ['link'],

	    data: function data() {
	        return {
	            events: [{ id: 0, title: 'Loading...' }],
	            selected: ''
	        };
	    },
	    created: function created() {
	        var _this = this;

	        this.$resource('api/event/form').get().then(function (res) {
	            return _this.events = res.data;
	        });
	    },


	    watch: {
	        selected: function selected(_selected) {
	            if (_selected && _selected > 0) this.link = 'events/' + this.events[_selected].slug;else this.link = 'events';
	        }
	    }

	};

	window.Links.components['events'] = module.exports;

/***/ },
/* 2 */
/***/ function(module, exports) {

	module.exports = "\n<div class=\"uk-form-row\">\n    <label for=\"form-link-events\" class=\"uk-form-label\">{{ 'Events' | trans }}</label>\n    <div class=\"uk-form-controls\">\n        <select id=\"form-link-events\" class=\"uk-width-1-1\" v-model=\"selected\">\n            <option value=\"0\" style=\"font-weight: bold\" selected>{{ 'Calender view' | trans }}</option>\n            <option v-for=\"event in events\" :value=\"event.id\">{{ event.title }}</option>\n        </select>\n    </div>\n</div>\n";

/***/ }
/******/ ]);