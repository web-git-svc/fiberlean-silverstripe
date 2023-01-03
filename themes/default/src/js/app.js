/*!
 * Javascript
 * ---------------------------------------------------------------------------------
 */

import './classes/StickyHeader';
import {ElementFullWidthCarousel}         from './components/ElementFullWidthCarousel';
import {NavMenuHandler, OffCanvasHandler} from './components/Navigation';
import {ElementSlideshow}                 from "./components/ElementSlideshow";
import {FluentDropdown}                   from './components/FluentDropdown';

const init = _ => {
  FluentDropdown();
  ElementFullWidthCarousel();
  ElementSlideshow();
  NavMenuHandler();
  OffCanvasHandler();
}

window.addEventListener('load', init);
