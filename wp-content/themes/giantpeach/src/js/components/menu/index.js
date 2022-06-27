import transitionend from '../../util/transitionend';
import { disableBodyScroll, enableBodyScroll, clearAllBodyScrollLocks } from 'body-scroll-lock';

function Menu(opt) {
  var options = {
      button: '.menu-button',
      nav: '.js.nav',
      nav_scroller: '.nav__inner'
    },
    obj = {},
    body = document.querySelector('body');

  if (typeof opt === 'object') {
    extendDefaults(options, opt);
  }

  init();

  function init() {
    obj.menuButtons = document.querySelectorAll(options.button);
    obj.nav = document.querySelector(options.nav);
    obj.nav_scroller = document.querySelector(options.nav_scroller);
    if (!obj.nav || obj.menuButtons.length < 1) {
      return false;
    }
    obj.nav.addEventListener('click', function(e) {
      e.stopPropagation();
    });
    for (let i = 0; i < obj.menuButtons.length; i++) {
      obj.menuButtons[i].addEventListener('click', button__click);
    }
  }

  function button__click(e) {
    e.stopPropagation();
    setTimeout(function(){
      obj.nav.classList.toggle('is-open');
      body.classList.toggle('is-menu-open');
      if (obj.nav.classList.contains('is-open')) {
        disableBodyScroll(obj.nav_scroller);
      } else {
        clearAllBodyScrollLocks();
      }
    },1);


    obj.nav.addEventListener(transitionend, function() {
      document.addEventListener('click', body__click);
    });
  }

  function body__click(e) {
    obj.menuButton.classList.remove('is-menu-open');
    obj.nav.classList.remove('is-open');
    body.classList.remove('is-menu-open');
    clearAllBodyScrollLocks();

    document.removeEventListener('click', body__click);
  }

  function extendDefaults(src, prop) {
    var property;
    for (property in prop) {
      if (prop.hasOwnProperty(property)) {
        src[property] = prop[property];
      }
    }
  }
}

export default Menu;
