class StickyHeader extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.header = document.querySelector('[data-header-wrapper]');
    this.headerBounds = {};
    this.currentScrollTop = 0;
    this.preventReveal = false;
    this.onScrollHandler = this.onScroll.bind(this);

    window.addEventListener('scroll', this.onScrollHandler, false);

    this.createObserver();
  }

  createObserver() {
    let observer = new IntersectionObserver((entries, observer) => {
      this.headerBounds = entries[0].intersectionRect;
      observer.disconnect();
    });

    observer.observe(this.header);
  }

  onScroll() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const heightToTrigger = (this.headerBounds.bottom * 1.5);

    if (scrollTop > this.currentScrollTop && scrollTop > heightToTrigger) {
      requestAnimationFrame(this.hide.bind(this));
    } else if (scrollTop < this.currentScrollTop && scrollTop > heightToTrigger) {
      if (!this.preventReveal) {
        requestAnimationFrame(this.reveal.bind(this));
      } else {
        window.clearTimeout(this.isScrolling);

        this.isScrolling = setTimeout(() => {
          this.preventReveal = false;
        }, 66);

        requestAnimationFrame(this.hide.bind(this));
      }
    } else if (scrollTop <= this.headerBounds.top) {
      requestAnimationFrame(this.reset.bind(this));
    }


    this.currentScrollTop = scrollTop;
  }

  hide() {
    this.header.classList.add('header-wrapper--hidden', 'header-wrapper--sticky');
  }

  reveal() {
    this.header.classList.add('header-wrapper--sticky', 'animate');
    this.header.classList.remove('header-wrapper--hidden');
  }

  reset() {
    this.header.classList.remove('header-wrapper--hidden', 'header-wrapper--sticky', 'animate');
  }
}

customElements.define('sticky-header', StickyHeader);
