/**
 * IntersectionObserver: Adding 'active' class to .bottom-form-header__image 
 * when the form appears in the viewport with a delay of 3 seconds.
 * Removes the 'active' class when the form leaves the viewport.
 */

document.addEventListener('DOMContentLoaded', function () {
    const formContent = document.querySelector('.bottom-form__content');
    const formImage = document.querySelector('.bottom-form-header__image');
    const formImageMobile = document.querySelector('.bottom-form-header__image-mobile');
    if (formContent && formImage) {
      let timer;
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            timer = setTimeout(() => {
              formImage.classList.add('active');
              formImageMobile.classList.add('active');
            }, 1500);
          } else {
            clearTimeout(timer);
            formImage.classList.remove('active');
            formImageMobile.classList.remove('active');
          }
        });
      });
      observer.observe(formContent);
    }
});