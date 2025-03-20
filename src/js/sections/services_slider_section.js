document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".carouselSwiper", {
      loop: true,
      autoplay: {
        delay: 2000,
      },
      spaceBetween: 10,
      slidesPerView: 1,
      breakpoints: {
        576: {
            slidesPerView: 2,
            spaceBetween: 80,
        },
        768: {
            slidesPerView: 1,
            spaceBetween: 40,
        }
    }
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.carousel-container');
  const items = document.querySelectorAll('.carousel-item');
  const itemWidth = 40;
  const gap = 4;
  const totalItems = items.length;
  
  let lastScrollPos = window.pageYOffset;
  let scrollDirection = 'down';

  window.addEventListener('scroll', () => {
    const currentScrollPos = window.pageYOffset;
    scrollDirection = currentScrollPos > lastScrollPos ? 'down' : 'up';
    lastScrollPos = currentScrollPos;
  });

  const initialOffset = 40;
  const initialPosition = initialOffset - (itemWidth / 2);

  gsap.set(container, { 
    x: `${initialPosition}vw`,
    marginRight: `${100 - initialOffset}vw`
  });

  const viewportWidth = window.innerWidth;
  const maxAllowedOffset = viewportWidth * 2.8;

  const lastItem = items[items.length - 1];
  const totalContentWidth = 
    (itemWidth + gap) * totalItems * (viewportWidth / 100) + 
    (initialOffset * viewportWidth / 100) -
    (viewportWidth * 0.85);

  const rawEndPosition = -totalContentWidth;
  const endPosition = Math.max(rawEndPosition, -maxAllowedOffset);

  const tl = gsap.timeline({ defaults: { ease: 'none' } });
  tl.to(container, { 
    x: endPosition,
    duration: 1
  });

  function throttle(callback, delay) {
    let lastCall = 0;
    return function(...args) {
      const now = new Date().getTime();
      if (now - lastCall >= delay) {
        lastCall = now;
        callback(...args);
      }
    };
  }

  const controller = new ScrollMagic.Controller();

  new ScrollMagic.Scene({
    triggerElement: '.section-items',
    duration: totalContentWidth * 0.8,
    triggerHook: 0,
  })
  .setPin('.section-items')
  .setTween(tl)
  .on('progress', throttle(({ progress }) => {
    items.forEach((item, index) => {
      const itemRect = item.getBoundingClientRect();

      const centerThreshold = viewportWidth * 0.25;
      const opacity = 1 - Math.min(
        Math.max((itemRect.left - centerThreshold) / 200, 0), 
        1
      );
      const textDelayFactor = 0.15;
      const textOpacity = Math.max(0, opacity - textDelayFactor) / (1 - textDelayFactor);

      if (index === 0) {
        gsap.set(item.querySelector('.description'), { 
          opacity: 1,
          x: 0
        });
        gsap.set(item.querySelector('.carousel-item__image-wrapper'), { 
          rotation: 0,
          width: 300,
          height: 370
        });
        gsap.set(item.querySelector('.carousel-item__number'), {
          width: 81, 
          height: 81, 
          lineHeight: '81px', 
          fontSize: '32px'
        });
        return;
      }
    
      gsap.to(item.querySelector('.description'), {
        opacity: textOpacity,
        x: scrollDirection === 'up' ? 100 * (1 - textOpacity) : -100 * (1 - textOpacity),
        duration: 0.5,
        overwrite: true,
        ease: 'power2.out'
      });

      gsap.to(item.querySelector('.carousel-item__image-wrapper'), {
        rotation: 20 - (20 * opacity),
        width: 406 - (106 * opacity),
        height: 500 - (130 * opacity),
        duration: 0.5,
        overwrite: true,
        ease: 'power2.out'
      });

      gsap.to(item.querySelector('.carousel-item__number'), {
        width: 81 - (21 * opacity),
        height: 81 - (21 * opacity),
        lineHeight: `${81 - (21 * opacity)}px`,
        fontSize: `${32 - (16 * opacity)}px`,
        duration: 0.5,
        overwrite: true,
        ease: 'power2.out'
      });

  });
}, 50))
  .addTo(controller);
});

// Gentle Parallax Drift Effect
// This code creates a subtle "floating parallax" effect,
// where elements with the .parallax-item class move up and down randomly,
// maintaining their initial position and adding a little movement as the page scrolls.
// When the page loads, save the initial position of each elements
document.addEventListener('DOMContentLoaded', () => {
  const parallaxItems = document.querySelectorAll('.parallax-item');
  
  parallaxItems.forEach(item => {
    item.dataset.initialY = item.offsetTop; 
  });
});

document.addEventListener('scroll', () => {
  const parallaxItems = document.querySelectorAll('.parallax-item');
  const scrollPosition = window.scrollY;

  parallaxItems.forEach(item => {
    const speed = parseFloat(item.dataset.speed) || 0.1;
    const initialY = parseFloat(item.dataset.initialY);
    const randomOffset = (Math.random() - 0.5) * 20;
    item.style.transform = `translateY(${randomOffset}px)`;
  });
});


