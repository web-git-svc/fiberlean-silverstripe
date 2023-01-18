import Splide from '@splidejs/splide';

export const ElementHero = () => {
  const heroes = document.querySelectorAll('[data-element-hero-carousel]');

  const initCarousel = carousel => {
    new Splide(carousel, {
      type: 'fade',
      arrows: false,
      pagination: false,
      rewind: true,
      autoplay: true,
      interval: 5000,
      speed: 1500,
      pauseOnHover: false,
      pauseOnFocus: false,
    }).mount();
  }

  heroes.forEach(initCarousel);
}
