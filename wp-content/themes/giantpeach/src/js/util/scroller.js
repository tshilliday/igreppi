var extendDefaults = require("@giantpeach/extend-defaults");
const isBot = !("onscroll" in window) || /glebot/.test(navigator.userAgent);

"use strict";

function Scroll(element, opt) {
    var that = this,
        i = 0;

    this.options = {
        lastScroll: 0,
        ticking: false,
        window: {
            width: 0,
            height: 0
        },
        document: {
            width: 0,
            height: 0,
            center: 0
        },
        element: {
            el: "",
            top: 0,
            bottom: 0,
            center: 0
        },
        trigger: "center",
        callback: ""
    };

    if (typeof opt === "object") {
        extendDefaults(that.options, opt);
    }

    that.options.window.width = window.innerWidth;
    that.options.window.height = window.innerHeight;
    that.options.element.el = element;
    this.calculatePosition();

    this.options.scrolllistener = that.onScroll.bind(that);
    this.clean = this.cleanUp;

    window.addEventListener("scroll", this.options.scrolllistener, false);
}

Scroll.prototype.calculatePosition = function () {
    var rect = this.options.element.el.getBoundingClientRect();
    var body = document.body,
        html = document.documentElement;
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    this.options.document.height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
    this.options.document.width = document.documentElement.scrollWidth;

    if (this.options.trigger === "center") {
        // this.options.element.top = rect.top + scrollTop - (( (rect.bottom + scrollTop) - (rect.top + scrollTop)) / 2);
        this.options.element.top = rect.top + scrollTop - ( (rect.height) / 2);
        this.options.element.top = rect.top + scrollTop;
        this.options.element.bottom = rect.bottom + scrollTop - ((rect.bottom - rect.top) / 2);
    } else {
        this.options.element.top = rect.top + scrollTop;
        this.options.element.bottom = rect.bottom + scrollTop;
    }

    if (isBot) {
        this.options.callback.call(this.options.element.el);
    }
};

Scroll.prototype.cleanUp = function () {
    window.removeEventListener("scroll", this.options.scrolllistener, false);
};

Scroll.prototype.onScroll = function () {
    this.options.lastScroll = window.scrollY;
    this.options.document.center = this.options.lastScroll + (this.options.window.height / 2);
    this.requestTick();
};

Scroll.prototype.update = function () {
    this.options.ticking = false;

    // if (this.options.lastScroll >= this.options.element.top && this.options.lastScroll <= this.options.element.bottom) {
    //     this.options.callback.call(this.options.element.el);
    // }

    if (this.options.trigger == "center") {
        if (parseInt(this.options.lastScroll + (this.options.window.height / 2)) >= this.options.element.top ) {
            this.options.callback.call(this.options.element.el);

            if (this.options.once) {
                window.removeEventListener("scroll", this.options.scrolllistener, false);
            }

        }
    } else if (this.options.trigger == "top") {
        if (this.options.lastScroll >= this.options.element.top ) {
            this.options.callback.call(this.options.element.el);

            if (this.options.once) {
                window.removeEventListener("scroll", this.options.scrolllistener, false);
            }

        }
    } else {
        if (this.options.lastScroll + this.options.window.height > this.options.element.bottom) {

            this.options.callback.call(this.options.element.el);

            if (this.options.once) {
                window.removeEventListener("scroll", this.options.scrolllistener, false);
            }
        }
    }

};

Scroll.prototype.requestTick = function () {
    if (!this.options.ticking) {
        window.requestAnimationFrame(this.update.bind(this));
    }
    this.options.ticking = true;
};

export default Scroll;
