document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".approach-slider__content", {
      slidesPerView: 1,
      spaceBetween: 20,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      
      breakpoints: {
        992: {
          slidesPerView: 2
        }
      }
  });
});