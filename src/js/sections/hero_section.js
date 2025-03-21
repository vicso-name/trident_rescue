document.addEventListener('DOMContentLoaded', function() {
    const heroSwiper = document.querySelector('.hero-swiper');
    if (heroSwiper) {
        new Swiper(heroSwiper, {
            loop: true,
            slidesPerView: 1,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false
            },
            speed: 500
        });
    }
});