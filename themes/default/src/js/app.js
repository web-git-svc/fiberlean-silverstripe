/*!
 * Javascript
 * ---------------------------------------------------------------------------------
 */

import './classes/StickyHeader';
import {ElementFullWidthCarousel}         from './components/ElementFullWidthCarousel';
import {NavMenuHandler, OffCanvasHandler} from './components/Navigation';
import {ElementSlideshow} from "./components/ElementSlideshow";

const init = _ => {
  ElementFullWidthCarousel();
  ElementSlideshow();
  NavMenuHandler();
  OffCanvasHandler();
}

window.addEventListener('load', init);
