import ajax from "@fdaciuk/ajax";

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
    init() {},
    finalize() {
        
        jQuery(document).ready(function() {
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains("next-posts-link")) {
                    event.preventDefault();
                    document.getElementById('post_navigation').classList.add('waiting');
                    loadMore(event.target.href);
                }
                if (event.target.classList.contains("post__cat-link")) {
                    event.preventDefault();
                    // document.getElementById('post_navigation').classList.add('waiting');
                    event.target.classList.add('active');
                    let links = document.querySelectorAll('.post__cat-link');
                    for (let i = 0; i < links.length; i++) {
                        links[i].classList.remove('active');
                    }
                    event.target.classList.add('active');
                    filterPosts(event.target.href);
                }
            });
        });

        function loadMore(href) {
            const site_posts_navigation = document.getElementById('post_navigation');
            const site_posts_container = document.querySelector('.r--posts');

            if (href && site_posts_navigation && site_posts_container) {
                ajax().get(href).then(function(response, xhr) {
                    const faker = document.createElement('div');
                    faker.innerHTML = response;
                    let posts_navigation = faker.querySelector('#post_navigation');
                    let posts = faker.querySelectorAll('.content-block--post');

                    for (let i=0; i < posts.length; i++) {
                        site_posts_container.appendChild(posts[i]);
                    }

                    site_posts_navigation.innerHTML = posts_navigation.innerHTML;

                    document.getElementById('post_navigation').classList.remove('waiting');
                });
            }
        }

        function filterPosts(href) {
            const site_posts_navigation = document.getElementById('post_navigation');
            const site_posts_container = document.querySelector('.r--posts');

            if (href && site_posts_container) {

                site_posts_container.classList.add('waiting');

                ajax().get(href).then(function(response, xhr) {
                    const faker = document.createElement('div');
                    faker.innerHTML = response;
                    let posts_navigation = faker.querySelector('#post_navigation');
                    let posts = faker.querySelectorAll('.content-block--post');

                    site_posts_container.innerHTML = "";
                    for (let i=0; i < posts.length; i++) {
                        site_posts_container.appendChild(posts[i]);
                    }

                    site_posts_navigation.innerHTML = posts_navigation.innerHTML;

                    document.dispatchEvent(new CustomEvent('posts-reload'));

                    site_posts_container.classList.remove('waiting');
                });
            }
        }
    }
}