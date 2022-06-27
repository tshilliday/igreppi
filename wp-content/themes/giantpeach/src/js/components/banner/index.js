import Flickity from "flickity";
import canAutoplay from "can-autoplay";
import objectFitPolyfill from "objectFitPolyfill";

require("flickity/dist/flickity.css");

function Banner(selector) {

    const banner = document.querySelector(selector);

    if (!banner) return;

    const banner_videos = banner.querySelectorAll('.banner__video');
    const isEdge = window.navigator.userAgent.indexOf("Edge") > -1;
    const isIE = /Trident|MSIE/.test(navigator.userAgent);

    if (banner.classList.contains('js')) {
        this.banner = new Flickity(selector, {
            cellAlign: "left",
            wrapAround: true,
            autoPlay: 4000,
            selectedAttraction: 0.1,
            friction: 1
        });
    }

    if (banner_videos.length) {
        canAutoplay.video({inline: true, muted: true, timeout: 1000}).then(({result, error}) => {
            if (!result) {
                hideVideos();
            }
        });
    }

    function hideVideos() {
        for (let i=0; i < banner_videos.length; i++) {
            banner_videos[i].style.display = "none";
        }
    }

}

export default Banner;
