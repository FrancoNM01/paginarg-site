(function () {
  function initRunway() {
    var runway = document.querySelector('[data-runway]');
    if (!runway || runway.getAttribute('data-runway-ready') === 'true') {
      return;
    }

    var slides = Array.prototype.slice.call(runway.querySelectorAll('[data-runway-slide]'));
    var dots = Array.prototype.slice.call(runway.querySelectorAll('[data-runway-dot]'));
    if (slides.length < 2 || !dots.length) {
      return;
    }

    runway.setAttribute('data-runway-ready', 'true');

    var index = 0;
    var timer = null;
    var interval = 1700;

    function show(nextIndex) {
      index = (nextIndex + slides.length) % slides.length;

      slides.forEach(function (slide, slideIndex) {
        var isActive = slideIndex === index;
        slide.classList.toggle('is-active', isActive);
        slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
      });

      dots.forEach(function (dot, dotIndex) {
        var isActive = dotIndex === index;
        dot.classList.toggle('is-active', isActive);
        dot.setAttribute('aria-pressed', isActive ? 'true' : 'false');
      });
    }

    function stop() {
      if (timer) {
        window.clearInterval(timer);
        timer = null;
      }
    }

    function start() {
      stop();
      timer = window.setInterval(function () {
        show(index + 1);
      }, interval);
    }

    dots.forEach(function (dot) {
      dot.addEventListener('click', function () {
        var nextIndex = Number(dot.getAttribute('data-index') || 0);
        show(nextIndex);
        start();
      });
    });

    runway.addEventListener('mouseenter', stop);
    runway.addEventListener('mouseleave', start);
    document.addEventListener('visibilitychange', function () {
      if (document.hidden) {
        stop();
      } else {
        start();
      }
    });

    show(0);
    start();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initRunway);
  } else {
    initRunway();
  }

  window.addEventListener('load', initRunway);
})();
