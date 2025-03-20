document.addEventListener('DOMContentLoaded', function () {

  const isMobile = window.matchMedia("(max-width: 992px)").matches;
  const swiper = new Swiper('.information__slider', {
    loop: true,
    speed: 800,
    effect: isMobile ? 'slide' : 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
      delay: 1000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      renderBullet: function (index, className) {
        return `
          <span class="${className}">
            <span class="progress-bar"></span>
          </span>`;
      },
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    touchEventsTarget: 'container',
    simulateTouch: true,
    allowTouchMove: isMobile,
    on: {
      init: function () {
        this.pagination.bullets.forEach(bullet => {
          const bar = bullet.querySelector('.progress-bar');
          bar.style.width = '0%';
          bar.style.transition = 'none'; 
        });

        const firstBullet = this.pagination.bullets[this.realIndex];
        if (firstBullet) {
          const bar = firstBullet.querySelector('.progress-bar');
          bar.getBoundingClientRect(); 
          bar.style.transition = `width ${this.params.autoplay.delay}ms linear`;
          bar.style.width = '100%';
        }
      },

      slideChangeTransitionStart: function () {
        this.pagination.bullets.forEach(bullet => {
          const bar = bullet.querySelector('.progress-bar');
          bar.style.width = '0%';
          bar.style.transition = 'none';
        });

        const activeBullet = this.pagination.bullets[this.realIndex];
        if (activeBullet) {
          const bar = activeBullet.querySelector('.progress-bar');
          bar.getBoundingClientRect();
          bar.style.transition = `width ${this.params.autoplay.delay}ms linear`;
          bar.style.width = '100%';
        }
      },
    },
  });
});
