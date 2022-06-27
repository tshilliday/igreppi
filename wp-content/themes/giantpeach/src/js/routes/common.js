import Menu from "../components/menu";
import Table from "../util/table";
import Overlays from "../util/overlay";
import Banner from "../components/banner";
import Layout from "../components/layout";
import ScrollTo from "../components/scrollto";
import ScrollViewport from '../util/scroll-viewport';
import Moveit from "../util/moveit";
import VideoPlayer from "../components/videoPlayer";
import 'lazysizes';
import { clearAllBodyScrollLocks } from 'body-scroll-lock';

// event
(function() {
  if (typeof window.CustomEvent === "function") return false; //If not IE

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
})();

export default {
    init() {
    },
    finalize() {
        this.initScrollViewport();
        var table = new Table(),
            moveit = new Moveit(),
            // banner = new Banner('.banner'),
            overlays = new Overlays,
            menu = new Menu,
            layout = new Layout,
            scrollto = new ScrollTo();

        var $this = this;

        document.addEventListener('pageAfterLoad', function() {
          clearAllBodyScrollLocks();
          document.querySelector('body').classList.add('js-enabled');
          document.querySelector('body').classList.remove('no-js');
          // menu = new Menu;
          $this.initScrollViewport.bind($this);
          setTimeout(() => {
            if (typeof sbi_init !== 'undefined') {
                // Instagram Feed
                // https://smashballoon.com/my-photos-dont-show-up-sometimes-unless-i-refresh-my-page-ajax-theme/
                sbi_init(function(i,t,a,b) {
                    sbi_cache_all(i,t,a,b);
                });
            }
          }, 500);

        });

        const videoPlayers = document.querySelectorAll('.video-player');
        [].forEach.call(videoPlayers, function(player) {
            new VideoPlayer(player);
        });

        if (this.isIE()) {
          document.querySelector('body').classList.add('ie');
        }

    },
    initScrollViewport() {
        setTimeout(() => {
            this.scrollAnimations = new ScrollViewport({
                className: '.scroll-trigger'
            });
        }, 500);
    },
    isIE() {
      return (
        navigator.userAgent.indexOf('MSIE') !== -1 ||
        navigator.appVersion.indexOf('Trident/') > -1
      );
    }
};
