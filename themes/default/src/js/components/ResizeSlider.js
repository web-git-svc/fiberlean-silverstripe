/**
 * Adjusts slider height to match max child item height
 */
function ResizeSlider(Splide, Components, options) {
  const SPLIDE_SLIDE_NEXT_ACTIVE_CLASS = 'splide__slide--next-active';

  const siblings = (node) => {
    if (node && node.parentNode) {
      let n = node.parentNode.firstChild;
      let matched = [];

      for (; n; n = n.nextSibling) {
        if (n.nodeType === 1 && n !== node) {
          matched.push(n);
        }
      }

      return matched;
    }

    return [];
  }

  const Component = {
    mount() {
      this.changeActiveSlide();
      this.updateTrackHeight();
    },

    changeActiveSlide() {
      let slide = Components.Elements.slides[Splide.index];
      slide?.classList?.add(SPLIDE_SLIDE_NEXT_ACTIVE_CLASS);

      siblings(slide).forEach((sibling) => {
        sibling.classList.remove(SPLIDE_SLIDE_NEXT_ACTIVE_CLASS);
      });
    },

    updateTrackHeight() {
      const track = Components.Elements.track;
      const activeSlide = track.querySelector(`.${SPLIDE_SLIDE_NEXT_ACTIVE_CLASS}`);
      if (!activeSlide) {
        return;
      }

      // Grab the active slide plus as many siblings as will be visible
      const index = Array.prototype.indexOf.call(Components.Elements.slides, activeSlide);
      const activeSlides = Components.Elements.slides.slice(index, index + options.perPage);

      // Find the max height
      let activeSlideHeight = 0;
      activeSlides.forEach((activeSlide) => {
        let height = activeSlide.offsetHeight;
        if (height > activeSlideHeight) {
          activeSlideHeight = height;
        }
      });

      // Update track height
      track.style.height = `${activeSlideHeight}px`;
    },
  };

  Splide.on('move', () => {
    Component.changeActiveSlide();
    Component.updateTrackHeight();
  });
  Splide.on('mounted', () => {
    Component.changeActiveSlide();
    Component.updateTrackHeight();
  });
  Splide.on('resize', () => {
    Component.changeActiveSlide();
    Component.updateTrackHeight();
  });

  return Component;
}

export default ResizeSlider;
