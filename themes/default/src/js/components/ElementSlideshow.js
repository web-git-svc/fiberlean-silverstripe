import Splide from '@splidejs/splide';

export const ElementSlideshow = () => {
  const carousels = document.querySelectorAll('[data-element-slideshow-carousel]');

  const initCarousel = carousel => {
    new Splide(carousel).mount();
  }

  carousels.forEach(initCarousel);
}
