'use strict';

var merge = require('lodash/merge');
var scrollTrack = require('scrollmonitor');

/**
 * Constructor Scroll trigger module that allows for custom animations
 *
 * @class ScrollViewport
 *
 * @classdesc a module to quickly develop scroll trigger animations
 *
 * @param {Object} options - Object instantiation options
 * @param {Number} [options.triggerClass='.scroll-trigger'] The class to add scroll trigger events to
 * @param {Number} [options.activeClass='in-viewport'] The class to add to elements once triggered
 * @param {Number} [options.animations={}] An object of animation functions
 */
function ScrollViewport (options) {
	// References
	this.options = merge({}, ScrollViewport.DEFAULTS, options);
	this.scrollTriggerElems = [];
	this.scrollTriggerElemsLen = 0;
	this.watchers = [];
    // All bindings
	this.destroy = this.destroy.bind(this);
    // Setup
	this._setup();
}

ScrollViewport.DEFAULTS = {
	triggerClass: '.scroll-trigger',
	activeClass: 'in-viewport',
	animations: {}
};

module.exports = ScrollViewport;

/**
 * Setup method
 * @private
 * @return {null}
 */
ScrollViewport.prototype._setup = function () {
	var i;
  var scrollOffset;
  var defaultOffset = window.innerHeight / 6 * -1;
	this.scrollTriggerElems = [].slice.call(document.querySelectorAll(this.options.triggerClass));
	this.scrollTriggerElemsLen = this.scrollTriggerElems.length;
	i = this.scrollTriggerElemsLen;
	while (i--) {
    scrollOffset = parseInt(this.scrollTriggerElems[i].getAttribute('data-scroll-offset') || 0, 10);
    if (!scrollOffset) {
      scrollOffset = defaultOffset;
    }
		this.watchers[i] = scrollTrack.create(this.scrollTriggerElems[i], scrollOffset);
		this.watchers[i].customAnimation = this.scrollTriggerElems[i].getAttribute('data-custom-animation');
    this.watchers[i].customAnimationHasRun = false;
		this.watchers[i].enterViewport(this._onEnterViewport.bind(this, this.watchers[i]));
  }
};

/**
 * Triggered when an element enters the viewport
 * @private
 * @return {null}
 */
ScrollViewport.prototype._onEnterViewport = function (watcher) {
		if (watcher.customAnimation && !watcher.customAnimationHasRun) {
			watcher.customAnimationHasRun = true;
			this.options.animations[watcher.customAnimation](watcher.watchItem);
    }
    var that = this;
    watcher.watchItem.classList.add(that.options.activeClass);
    watcher.destroy();
    watcher = null;
};

/**
 * The Destroy method, to kill this stuff
 * @public
 * @return {null}
 */
ScrollViewport.prototype.destroy = function () {
	var i = this.watchers.length;
	while (i--) {
		if (this.watchers[i] && typeof this.watchers[i].destroy === 'function') {
			this.watchers[i].destroy();
			this.watchers[i] = null;
		}
	}
};
