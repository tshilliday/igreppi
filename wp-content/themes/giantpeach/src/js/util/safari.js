function detectsafari() {
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf('safari') != -1) {
      if (!(ua.indexOf('chrome') > -1)) {
        return true;
      }
    }
    return false;
}

export default detectsafari;
