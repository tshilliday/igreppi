// import "jquery";
import Router from "./util/Router";
import PageController from "./util/page-controller";

import common from "./routes/common";

import blog from "./routes/blog";
const category = blog;

const routes = new Router({
    common,
    blog,
    category
});

function ready(func) {
    if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
        func();
    } else {
        document.addEventListener("DOMContentLoaded", func);
    }
}

function loadEvents() {
    if (!isBrowserIE() && window.innerWidth > 1024) {
            const pagecontroller = new PageController({
            classes: {
                link: ".ajax",
                wrapper: ".outer",
                transitionElement: ".ajax-transition",
                in: "transition-in",
                out: "transition-out"
            },
            events: {
                afterLoad: function () {
                    routes.loadEvents();
                }
            }
        });
    } else {
        routes.loadEvents();
    }
}

ready(loadEvents);

function isBrowserIE() {
    return (
      navigator.userAgent.indexOf('MSIE') !== -1 ||
      navigator.appVersion.indexOf('Trident/') > -1
    );
}
