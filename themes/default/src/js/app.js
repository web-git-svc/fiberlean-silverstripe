/*!
 * Javascript
 * ---------------------------------------------------------------------------------
 */

import './classes/StickyHeader';
import {ElementFullWidthCarousel}         from './components/ElementFullWidthCarousel';
import {NavMenuHandler, OffCanvasHandler} from './components/Navigation';

const init = _ => {
  ElementFullWidthCarousel()
  NavMenuHandler();
  OffCanvasHandler();
}

window.addEventListener('load', init);
