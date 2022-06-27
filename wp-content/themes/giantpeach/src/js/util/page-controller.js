// util/page-controller

import extendDefaults from "@giantpeach/extend-defaults";
import ajax from "@fdaciuk/ajax";

import {
    animationEnd,
    transitionEnd
} from "cssevents";

"use strict";

(function () {
    if (typeof window.CustomEvent === "function") return false; //If not IE
    if (typeof window.Event === "function") return false; //If not IE

    function CustomEvent(event, params) {
        params = params || {
            bubbles: false,
            cancelable: false,
            detail: undefined
        };
        var evt = document.createEvent("CustomEvent");
        evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
        return evt;
    }

    CustomEvent.prototype = window.Event.prototype;

    window.CustomEvent = CustomEvent;
    window.Event = CustomEvent;
})();

function PageController(opt) {
    var that = this;

    that.options = {
        classes: {
            link: ".ajax",
            wrapper: ".outer",
            transitionElement: ".flood",
            in: "transition-in",
            out: "transition-out"
        },
        events: {
            init: "",
            afterLoad: "",
            click: ""
        },
        elements: {
            links: [],
            wrapper: "",
            transitionElement: ""
        },
        click: new CustomEvent("page-click"),
    };

    if (typeof opt === "object") {
        extendDefaults(that.options, opt);
    }

    this.eventListeners();

    if (typeof that.options.events.init === "function") {
        that.options.events.init.call();
    }

    window.addEventListener("popstate", function () {
        window.location.href = window.location.href;
    });

    if (typeof that.options.events.afterLoad === "function") {
        that.options.events.afterLoad.call(that);
    }
}

PageController.prototype.eventListeners = function () {
    var i = 0;
    this.options.elements.wrapper = document.querySelector(this.options.classes.wrapper);
    this.options.elements.transitionElement = document.querySelector(this.options.classes.transitionElement);
    this.options.elements.links = document.querySelectorAll(this.options.classes.link);

    for (i = 0; i < this.options.elements.links.length; i++) {
        this.options.elements.links[i].addEventListener("click", this.click.bind({
            link: this.options.elements.links[i],
            controller: this
        }), false);
    }
};

PageController.prototype.transitionEnd = function () {

    var that = this;

    this.controller.options.elements.transitionElement.removeEventListener(transitionEnd, this.controller.options.transitionEnd, false);
    this.controller.options.elements.transitionElement.removeEventListener(animationEnd, this.controller.options.transitionEnd, false);

    var bodyClass = this.content.querySelector("body"),
        title = this.content.querySelector("title");

    document.body.classList.value = bodyClass.classList.value;
    scroll(0, 0);

    if (title) {
        document.title = title.innerHTML;
    }

    this.controller.options.elements.wrapper.innerHTML = "";
    this.controller.options.elements.wrapper.innerHTML = this.content.querySelector(this.controller.options.classes.wrapper).innerHTML;

    document.dispatchEvent(new Event("pageLoad"));

    if (typeof this.controller.options.events.afterLoad === "function") {
        this.controller.eventListeners();
        this.controller.options.events.afterLoad.call(this);
        document.dispatchEvent(new Event("pageAfterLoad"));
    }

    document.body.classList.remove(this.controller.options.classes.out);
    document.body.classList.remove("waiting");
    document.body.classList.add(this.controller.options.classes.in);
    this.controller.options.elements.transitionElement.addEventListener(transitionEnd, that.controller.transitionInEnd.bind(that), false);
    this.controller.options.elements.transitionElement.addEventListener(animationEnd, that.controller.transitionInEnd.bind(that), false);
};

PageController.prototype.transitionInEnd = function () {
    var that = this;
    document.body.classList.remove(that.controller.options.classes.in);
    this.controller.options.elements.transitionElement.removeEventListener(transitionEnd, that.controller.transitionInEnd, false);
    this.controller.options.elements.transitionElement.removeEventListener(animationEnd, that.controller.transitionInEnd, false);
}

// PageController.prototype.update = function (obj) {
//     var bodyClass = obj.content.querySelector("body"),
//         title = obj.content.querySelector("title");

//     document.body.classList.remove(obj.controller.options.classes.out);
//     document.body.classList.value = bodyClass.classList.value;
//     document.title = title.innerHTML;
//     scroll(0, 0);

//     obj.controller.options.elements.wrapper.innerHTML = "";
//     obj.controller.options.elements.wrapper.innerHTML = obj.content.querySelector(obj.controller.options.classes.wrapper).innerHTML;

//     if (typeof obj.controller.options.events.afterLoad === "function") {
//         obj.controller.eventListeners();
//         obj.controller.options.events.afterLoad.call(obj);
//     }
// };

// PageController.prototype.update = function (obj) {
//     var bodyClass = obj.content.querySelector("body"),
//         title = obj.content.querySelector("title"),
//         scripts = obj.content.querySelector(obj.controller.options.classes.wrapper).querySelectorAll("script");

//     document.body.classList.remove(obj.controller.options.classes.out);
//     document.body.classList.value = bodyClass.classList.value;
//     document.body.title = title.innerHTML;
//     scroll(0, 0);

//     obj.controller.options.elements.wrapper.innerHTML = "";
//     obj.controller.options.elements.wrapper.innerHTML = obj.content.querySelector(obj.controller.options.classes.wrapper).innerHTML;

//     var inline = [],
//         loaded = 0;

//     for (var i = 0; i < scripts.length; i++) {
//         let tmp = document.createElement("script");

//         if (scripts[i].src != "") {
//             tmp.src = scripts[i].src;
//             tmp.type = "text/javascript";
//             obj.controller.options.elements.wrapper.appendChild(tmp);

//             tmp.addEventListener("load", function () {
//                 loaded++;
//                 appendScripts();
//             });

//         } else {
//             tmp.innerHTML = scripts[i].innerHTML;
//             tmp.type = "text/javascript";
//             inline.push(tmp);
//         }
//     }

//     function appendScripts() {
//         if (loaded >= scripts.length - inline.length) {
//             for (var i = 0; i < inline.length; i++) {
//                 obj.controller.options.elements.wrapper.appendChild(inline[i]);
//             }
//         }
//     }

//     if (typeof obj.controller.options.events.afterLoad === "function") {
//         obj.controller.eventListeners();
//         obj.controller.options.events.afterLoad.call(obj);
//         document.dispatchEvent(new Event("contentLoaded"));
//     }
// };

PageController.prototype.click = function (e, that) {
    if (typeof e !== "undefined") {
        e.preventDefault();
    }

    if (document.body.classList.contains("waiting")) {
        return false;
    }

    var that = this,
        url = that.link.getAttribute("href"),
        title = document.querySelector("title").innerText;

    // title = title.replace(" – Giant Peach", "");
    // title = title.replace(" | Giant Peach", "");

    document.body.classList.add("waiting");

    if (typeof that.controller.options.events.click === "function") {
        that.controller.options.events.click.call(that);
    }

    document.dispatchEvent(that.controller.options.click);

    document.dispatchEvent(new Event("pageClick"));

    ajax({
        headers: {
            "x-ref": "page-controller",
            "x-prev": encodeURIComponent(title)
        }
    }).get(url).always(function (response, xhr) {
        document.body.classList.add(that.controller.options.classes.out);

        var content = document.createElement("html");
        content.innerHTML = response;
        if (xhr.status === 200) {
            that.controller.options.transitionEnd = that.controller.transitionEnd.bind({
                controller: that.controller,
                content: content
            }, false);
            that.controller.options.elements.transitionElement.addEventListener(transitionEnd, that.controller.options.transitionEnd, false);
            that.controller.options.elements.transitionElement.addEventListener(animationEnd, that.controller.options.transitionEnd, false);
            // that.controller.update({controller: that.controller, content: content});
            history.pushState({}, "", url);
            if (typeof gtag !== 'undefined' && window.ga_tracking_id !== 'undefined') {
              gtag('config', window.ga_tracking_id, {
                'page_location' : url,
              });
            }
        } else {
            window.location.href = xhr.responseURL;
        }

    });
};

export default PageController;
