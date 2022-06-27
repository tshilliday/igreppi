import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock';

function extendDefaults(src, prop) {
    var property;

    for (property in prop) {
        if (prop.hasOwnProperty(property)) {
            src[property] = prop[property];
        }
    }
}

function Overlay(opt) {
    var that = this;

    that.options = opt;

    that.elements = {};

    if (typeof that.options.trigger === "string") {
      that.elements.trigger = document.querySelector(that.options.trigger);
    } else {
      that.elements.trigger = that.options.trigger;
    }

    that.elements.closeButton = document.querySelectorAll(that.options.classes.closeButton);

    if (that.elements.trigger !== null) {
        if (that.elements.trigger.length > 0) {
            for (var k = 0; k < that.elements.trigger.length; k++) {
                that.elements.trigger[k].addEventListener('click', that.open.bind(that), false);
                if (that.elements.trigger[k].getAttribute('data-target') !== null) {
                    that.elements.overlay = document.querySelector(that.elements.trigger[k].getAttribute('data-target'));
                    that.elements.inner = that.elements.overlay.children;
                }

            }
        }
        else {
            that.elements.trigger.addEventListener('click', that.open.bind(that), false);
            if (that.elements.trigger.getAttribute('data-target') !== null) {
                that.elements.overlay = document.querySelector(that.elements.trigger.getAttribute('data-target'));
                that.elements.inner = that.elements.overlay.children;
            }
        };

    } else {
        return;
    }

    if (that.elements.closeButton !== null) {
        for (var i=0;i<that.elements.closeButton.length; i++) {
            that.elements.closeButton[i].addEventListener('click', that.close.bind(that), false);
        }
    }

    if (typeof that.elements.inner[0] !== 'undefined') {
        that.elements.scrollable_element = that.elements.inner[0].querySelector('.overlay__content');
    }

    if (typeof that.options.events.init === 'function') {                   // Init Call
        that.options.events.init.call();
    }
}


Overlay.prototype.open = function (e) {
    if (typeof e !== "undefined") {
        e.preventDefault();
    }

    let overlay_id = this.elements.overlay.id;

    if (typeof this.options.events.beforeOpen === 'function') {             // Before Open Call
        this.options.events.beforeOpen.call(this.elements);
    }

    this.elements.overlay.classList.add('is-visible');
    this.elements.inner[0].addEventListener('click', function (e) { e.stopPropagation(); });
    this.elements.overlay.addEventListener('click', this.close.bind(this), false);

    if (typeof this.options.events.afterOpen === 'function') {              // After Open Call
        this.options.events.afterOpen.call();
    }

    if (this.elements.scrollable_element) {
        disableBodyScroll(this.elements.scrollable_element);
    }

    if (typeof gtag == 'function') {
        gtag('event', 'openOverlay', {
            'event_category' : 'Overlay',
            'event_label' : overlay_id,
        });
    }
    else if (typeof ga == 'function') {
      ga(
          'send',
          'event',
          'Overlay', // category
          'openOverlay', // action
          overlay_id, // label
      );
    }

};

Overlay.prototype.close = function (e) {
    if (typeof e !== "undefined") {
        e.preventDefault();
    }

    if (typeof this.options.events.beforeClose === 'function') {            // Before Close Call
        this.options.events.beforeClose.call();
    }

    this.elements.overlay.classList.remove('is-visible');
    this.elements.overlay.removeEventListener('click', this.close.bind(this));

    if (typeof this.options.events.afterClose === 'function') {             // After Close Call
        this.options.events.afterClose.call();
    }

    if (this.elements.scrollable_element) {
        enableBodyScroll(this.elements.scrollable_element);
    }
};

function Overlays(opt) {

  let options = {
      classes: {
          container: '.overlay',
          closeButton: '.overlay__close',
          openButton: '.overlay__button'
      },
      events: {
          init: '',
          beforeOpen: '',
          afterOpen: '',
          beforeClose: '',
          afterClose: ''
      }
  };

  if (typeof opt === 'object') {
      extendDefaults(options, opt);
  }

  const overlays = document.querySelectorAll(options.classes.container);

  for (var i = 0; i < overlays.length; i++) {
      let overlay_buttons = this.get_overlay_buttons(overlays[i].id, options.classes.openButton);
      if (overlay_buttons) {
        options.trigger = overlay_buttons;
        new Overlay(options);
      }
  }

}

Overlays.prototype.get_overlay_buttons = function(id, className) {
  let buttons = [];
  const all_overlay_buttons = document.querySelectorAll(className)
  for (var i = 0; i < all_overlay_buttons.length; i++) {
    if (all_overlay_buttons[i]) {
      buttons.push(all_overlay_buttons[i]);
    }
  }
  if (buttons.length) {
    return buttons;
  }
  return false;
}

export default Overlays;
