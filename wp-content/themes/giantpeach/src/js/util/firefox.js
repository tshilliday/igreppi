function detectfirefox() {
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf('firefox') != -1) {
        return true;
    }
    return false;
}

export default detectfirefox;
