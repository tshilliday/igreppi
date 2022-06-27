function ScrollTo() {
  
  let elements = document.querySelectorAll('.scroll-to');

  for (let i=0; i < elements.length; i++) {
      init(elements[i]);
  }

  function init(el) {
      if (typeof el.dataset.target !== 'undefined') {
        var target= document.querySelector(el.dataset.target);
        if (target) {
            el.addEventListener('click', function(event) {
                event.preventDefault();
                scrollToPosition(target);
            });
        }
      }
  }

  function scrollToPosition(target) {
    // if accordion, open accordion
    if (target.classList.contains('accordion') && !target.classList.contains('open')) {
        target.classList.toggle('open');
        jQuery(target.querySelector('.accordion-content')).slideToggle();
    }
    // scroll to
    jQuery([document.documentElement, document.body]).animate({
        scrollTop: jQuery(target).offset().top - 150
    }, 1000);
  }

}

export default ScrollTo;
