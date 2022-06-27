"use strict";

import extendDefaults from "@giantpeach/extend-defaults";

function Tween(element, opt) {
    var that = this,
        de = "";

    that.options = {
        callback: "",
        values: {
            start: 0,
            end: 0
        },
        resolution: 100,
        distance: {
            start: 0,
            startPercentage: 0,
            end: 100,
            endPercentage: 0,
            unit: "vh"  // vh, px, %
        },
        lastScroll: 0,
        scrollPercent: 0,
        ticking: false,
        debug: false
    };

    that.object = {
        window: {
            width: 0,
            height: 0
        },
        document: {
            height: 0
        },
        values: {
            step: []
        }
    };

    if (typeof opt === "object") {
        extendDefaults(that.options, opt);
    }

    if (element) {
        if (typeof element === "string") {
            that.object.element = document.querySelector(element);
        } else if (element.nodeType === 1) {
            that.object.element = element;
        } else {
            return false;
        }
    } else {
        return false;
    }

    if (that.object.element.getAttribute("data-on-screen")) {
        that.options.waitTillVisible = that.object.element.getAttribute("data-on-screen");
    }

    if (that.object.element.getAttribute("data-value-start")) {
        that.options.values.start = that.object.element.getAttribute("data-value-start");
    }

    if (that.object.element.getAttribute("data-value-end")) {
        that.options.values.end = that.object.element.getAttribute("data-value-end");
    }

    if (that.object.element.getAttribute("data-distance-start")) {
        that.options.distance.start = that.object.element.getAttribute("data-distance-start");
    }

    if (that.object.element.getAttribute("data-distance-end")) {
        that.options.distance.end = that.object.element.getAttribute("data-distance-end");
    }

    if (that.object.element.getAttribute("data-distance-unit")) {
        that.options.distance.unit = that.object.element.getAttribute("data-distance-unit");
    }

    this.calculate();

    window.addEventListener("scroll", that.onScroll.bind(that), false);

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    debounce = debounce(function() {
        that.calculate();
    }, 250);

    window.addEventListener("resize", debounce, false);

}

Tween.prototype.calculate = function () {
    var body = document.body,
        html = document.documentElement,
        rect = this.object.element.getBoundingClientRect();

    this.object.window.width = window.innerWidth;
    this.object.window.height = window.innerHeight;
    this.object.document.height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );

    this.object.offset = {
        top: rect.top + document.body.scrollTop,
        bottom: rect.bottom + document.body.scrollTop
    };

    if (this.options.waitTillVisible === "true") {
        if (this.options.distance.unit == "vh") {
            this.options.distance.startPercentage = (((this.object.window.height / 100) * (this.options.distance.start)) / (this.object.document.height - this.object.window.height)) * 100;
            this.options.distance.endPercentage = (((this.object.window.height / 100) * (this.options.distance.end)) / (this.object.document.height - this.object.window.height)) * 100;

            this.options.distance.startPercentage = ((this.object.offset.top / this.object.document.height) * 100) + (((this.object.window.height / 100) * (this.options.distance.start)) / (this.object.document.height - this.object.window.height)) * 100;
            this.options.distance.endPercentage = (this.object.offset.bottom / this.object.document.height * 100) + (((this.object.window.height / 100) * (this.options.distance.end)) / (this.object.document.height - this.object.window.height)) * 100;

        } else if (this.options.distance.unit == "px") {
            this.options.distance.startPercentage = ((this.options.distance.start) / (this.object.document.height - this.object.window.height)) * 100;
            this.options.distance.endPercentage = ((this.options.distance.end) / (this.object.document.height - this.object.window.height) * 100);
        } else if (this.options.distance.unit == "%") {

        }
    } else {
        if (this.options.distance.unit == "vh") {
            this.options.distance.startPercentage = (((this.object.window.height / 100) * this.options.distance.start) / (this.object.document.height - this.object.window.height)) * 100;
            this.options.distance.endPercentage = (((this.object.window.height / 100) * this.options.distance.end) / (this.object.document.height - this.object.window.height)) * 100;
        } else if (this.options.distance.unit == "px") {
            this.options.distance.startPercentage = ((this.options.distance.start) / (this.object.document.height - this.object.window.height)) * 100;
            this.options.distance.endPercentage = ((this.options.distance.end) / (this.object.document.height - this.object.window.height) * 100);
        } else if (this.options.distance.unit == "%") {

        }
    }

    for (var i = 0; i < this.options.resolution; i++) {
        this.object.values.step[i] = (this.options.values.start - ((this.options.values.start - this.options.values.end) / 100) * i);
    }

};

Tween.prototype.debug = function () {
    console.clear()
    console.log(this);
    console.log("Scroll Px: " + this.options.lastScroll + "px");
    console.log("Total Scroll Percent: " + Math.round(this.options.totalScrollPercent * 100) + "% (" + this.options.totalScrollPercent + ")");
    console.log("Tween Percent: " + Math.round(this.options.scrollPercent * 100) + "% (" + this.options.scrollPercent + ")" );
    console.log("Start Percent: " + this.options.distance.startPercentage + "%");
    console.log("End Percent: " + this.options.distance.endPercentage + "%");
};

Tween.prototype.onScroll = function () {
    this.options.lastScroll = window.scrollY;
    this.requestTick();
};

Tween.prototype.update = function () {
    this.options.ticking = false;
    this.options.totalScrollPercent = (this.options.lastScroll) / (this.object.document.height - this.object.window.height);

    if (Math.round(this.options.totalScrollPercent * 100) > this.options.distance.startPercentage) {
        // this.options.scrollPercent = (this.options.lastScroll - this.options.distance.start) / (this.object.document.height - this.options.distance.end);
        this.options.scrollPercent = (this.options.totalScrollPercent - (this.options.distance.startPercentage / 100)) / ((this.options.distance.endPercentage / 100) - (this.options.distance.startPercentage / 100));
    }

    if (Math.round(this.options.totalScrollPercent * 100) <= this.options.distance.startPercentage) {
        this.options.scrollPercent = 0;
    }

    if (this.options.debug) {
        this.debug(this);
    }

    this.options.callback.call(this.object.element, this.object.values.step[Math.round(this.options.scrollPercent * 100)], this.options.scrollPercent * 100);
};

Tween.prototype.requestTick = function () {
    if (!this.options.ticking) {
        window.requestAnimationFrame(this.update.bind(this));
    }
    this.options.ticking = true;
};

export default Tween;
