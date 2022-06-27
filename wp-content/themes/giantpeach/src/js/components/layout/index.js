
import throttle from "lodash/throttle";

function Layout() {
    this.footer = document.querySelector('.footer');
    this.header = document.querySelector('.header');
    this.content = document.querySelector('.wrapper');
    this.header_height;
    this.footer_height;
    this.last_scroll = 0;

    var that = this;

    jQuery(document).ready(function () {
        that.init();
    });
}

Layout.prototype.init = function () {
    this.setHeaderClearHeight();
    this.initHeaderScrollListener();
};

Layout.prototype.setFooterClearHeight = function () {
    this.footer_height = this.footer.getBoundingClientRect().height;
    this.wrapper.style.marginBottom = this.footer_height + 'px';
};

Layout.prototype.setHeaderClearHeight = function () {
    this.header_height = this.header.getBoundingClientRect().height;
};

Layout.prototype.initHeaderScrollListener = function () {

    var that = this;

    window.addEventListener(
        'scroll',
        throttle(that.checkClasses.bind(that),100),
        false
    );

    window.addEventListener(
        'load',
        that.checkClasses.bind(that),
        false
    );
};

Layout.prototype.checkClasses = function(event) {
  var that = this;
  var doc = document.documentElement;
  var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
  if (top <= 100) {
      that.header.classList.add('show');
      top++; // Fix for ie - trick that fixes showing/hiding on every scroll
  }
  else {
      that.header.classList.remove('show');
  }
  this.last_scroll = top;
}

export default Layout;
