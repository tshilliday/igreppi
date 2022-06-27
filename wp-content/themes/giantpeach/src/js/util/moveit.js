
import extendDefaults from "@giantpeach/extend-defaults";
import throttle from "lodash/throttle";
import debounce from "lodash/debounce";

function moveit(opt) {

    // if less than tablet landscape, don't run
    if (window.innerWidth < 1024) {
        return;
    }

    jQuery(document).ready(function() {

        var that = this;

        var instances = [],
            elements,
            i = 0;

        this.options = {
            selector: ".moveit"
        };

        if (typeof opt === "object") {
            extendDefaults(this.options, opt);
        }

        elements = document.querySelectorAll(this.options.selector);

        // for every .moveit
        for (i = 0; i < elements.length; i++) {
            if (getStyle(elements[i],'display') != "none") {
                // initialise moveit instance
                instances.push(new moveitItem(elements[i]));
                elements[i].style.opacity = 1;
            }
        }

    });

}

function getStyle(element, name) {
    return element.currentStyle ? element.currentStyle[name] : window.getComputedStyle ? window.getComputedStyle(element, null).getPropertyValue(name) : null;
}

function moveitItem(el) {

    this.el = el;

    this.style = window.getComputedStyle(el);
    this.speed = parseFloat(this.el.getAttribute("data-moveit-speed"));
    this.mode = this.el.getAttribute("data-moveit-mode");
    this.direction = this.el.getAttribute("data-moveit-direction");
    this.control = this.el.getAttribute("data-moveit-control");
    this.scroller = window;

    if (!this.control) {
        this.control = "self";
    }

    if (!this.speed) {
        this.speed = 5;
    }

    if (!this.mode) {
        this.mode = "default";
    }

    if (!this.direction) {
        this.direction = "down";
    }

    this.window = {
        innerHeight: window.innerHeight,
        innerWidth: window.innerWidth,
        scrollX: getBodyScrollX(),
        scrollY: getBodyScrollY(),
        scrollCenterX: getBodyScrollX() + (window.innerWidth / 2),
        scrollCenterY: getBodyScrollY() + (window.innerHeight / 2)
    };

    if (this.scroller == window) {
        this.scroller = this.window;
        this.scroller.el = window;
    }
    else {
        // TODO: handle other scroller elements.
    }

    // console.log(this.window);
    // console.log('speed');
    // console.log(this.speed);
    // console.log('mode');
    // console.log(this.mode);
    // console.log('control');
    // console.log(this.control);
    // console.log('direction');
    // console.log(this.direction);
    // console.log('position');
    // console.log(this.position);
    // console.log('controlPosition');
    // console.log(this.controlPosition);

    /* Position of moveit element */

    this.setPositions();

    var that = this;

    // first init
    this.updateTransform();

    this.scroller.el.addEventListener('scroll', throttle(function() {
      that.updateTransform();
    }, 10));

    window.addEventListener('resize', debounce(function() {
      that.reset();
    }, 500));

}

moveitItem.prototype.setPositions = function() {
  this.setElementPosition();
  this.setControlPosition();
}

moveitItem.prototype.setElementPosition = function() {
  this.rect = this.el.getBoundingClientRect();
  this.position = {
      top: this.rect.top + this.window.scrollY,
      left: this.rect.left + this.window.scrollX,
      x: getPosition(this.el).x,
      y: getPosition(this.el).y,
      offsetHeight: this.el.offsetHeight,
      offsetWidth: this.el.offsetWidth,
      translateX: 0,
      translateY: 0
  };
  this.position.centerY = this.position.top + (this.position.offsetHeight / 2);
  this.position.centerX = this.position.left + (this.position.offsetWidth / 2);
}

moveitItem.prototype.setControlPosition = function() {
  if (this.control == "parent" || this.control == "parentNode") {
    var controlEl = this.el.parentNode;
    var controlRect = controlEl.getBoundingClientRect();
    this.controlPosition = {
        top: controlRect.top + this.window.scrollY,
        left: controlRect.left + this.window.scrollX,
        x: getPosition(controlEl).x,
        y: getPosition(controlEl).y,
        offsetHeight: controlEl.offsetHeight,
        offsetWidth: controlEl.offsetWidth,
    }
    this.controlPosition.centerY = this.controlPosition.top + (this.controlPosition.offsetHeight / 2);
    this.controlPosition.centerX = this.controlPosition.left + (this.controlPosition.offsetWidth / 2);
  }
  else { // control is element itself
      this.controlPosition = this.position;
  }
}

moveitItem.prototype.reset = function () {

  this.el.style.opacity = 0;
  this.el.style.transform = "none";
  this.setPositions();
  this.updateTransform();
  this.el.style.opacity = 1;

};

moveitItem.prototype.updateTransform = function () {

    this.setScrollerPosition();

    if (this.direction == "up") {
        this.down(true);
    } else if (this.direction == "down") {
        this.down(false);
    } else if (this.direction == "left") {
        this.right(true);
    } else if (this.direction == "right") {
        this.right(false);
    }

};

moveitItem.prototype.setScrollerPosition = function() {
  if (this.scroller.el == window) {
    this.scroller.scrollX = getBodyScrollX();
    this.scroller.scrollY = getBodyScrollY();
    this.scroller.scrollCenterX = getBodyScrollX() + (window.innerWidth / 2);
    this.scroller.scrollCenterY =  getBodyScrollY() + (window.innerHeight / 2);
  }
}

moveitItem.prototype.down = function (reverse) {

    // Check relative positions, change transform
    var item = this;

    var start = (this.controlPosition.top) - this.scroller.innerHeight / 2 * 3,
        end = (this.controlPosition.top) + this.controlPosition.offsetHeight + this.scroller.innerHeight / 2;

    if (this.scroller.scrollY > start && this.scroller.scrollY < end) {

        var scrollDiff = this.scroller.scrollCenterY - this.controlPosition.centerY;
        if (reverse) { // TODO check this
            scrollDiff = scrollDiff * -1;
        }
        var pos = -1 * scrollDiff / this.speed + this.position.translateY;

        if (scrollDiff < 0) {
            if (item.mode != "after-scroll") {
                window.requestAnimationFrame(function () {
                    item.applyStyles(item, item.position.translateX , pos, 0);
                });
            }
        } else {
            if (item.mode != "before-scroll") {
                window.requestAnimationFrame(function () {
                    item.applyStyles(item, item.position.translateX, pos, 0);
                });
            }
        }
    }
};

moveitItem.prototype.right = function (reverse) {

    // Check relative positions, change transform
    // TODO check this - untested, copied from down()

    var item = this;

    var start = (this.controlPosition.left) - this.scroller.innerWidth / 2 * 3,
        end = (this.controlPosition.left) + this.controlPosition.offsetWidth + this.scroller.innerWidth / 2;

    if (this.scroller.scrollX > start && this.scroller.scrollX < end) {

        var scrollDiff = this.scroller.scrollCenterX - this.controlPosition.centerX;
        if (reverse) { // TODO check this
            scrollDiff = scrollDiff * -1;
        }
        var pos = -1 * scrollDiff / this.speed + this.position.translateX;

        if (scrollDiff < 0) {
            if (item.mode != "after-scroll") {
                window.requestAnimationFrame(function () {
                    item.applyStyles(item, pos, item.position.translateY, 0);
                });
            }
        } else {
            if (item.mode != "before-scroll") {
                window.requestAnimationFrame(function () {
                    item.applyStyles(item, pos, item.position.translateY, 0);
                });
            }
        }
    }
};

moveitItem.prototype.applyStyles = function (item, x, y, z) {
    item.el.style.transform = "translate3d(" + x + "px, " + y + "px, " + z + "px)";
};

function getPosition(element) {
    var xPosition = 0;
    var yPosition = 0;

    while (element) {
        xPosition += (element.offsetLeft - element.scrollLeft + element.clientLeft);
        yPosition += (element.offsetTop - element.scrollTop + element.clientTop);
        element = element.offsetParent;
    }

    return { x: xPosition, y: yPosition };
}

function getBodyScrollY() {
    return (window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0);
}

function getBodyScrollX() {
    return (window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0);
}

export default moveit;
