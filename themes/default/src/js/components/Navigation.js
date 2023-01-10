import {isTouchDevice} from '../helpers/isTouchDevice';

export const NavMenuHandler = () => {
  const navElements = document.querySelectorAll('[data-nav] > ul a');
  const navItems = document.querySelectorAll('[data-nav] > ul .nav__item');
  const activeClass = 'nav__item--hover';

  navElements.forEach(element => {
    element.addEventListener('touchend', event => {
      if (isTouchDevice() && !element.parentNode.classList.contains(activeClass)) {
        closeSubmenus();
        event.preventDefault();
        element.parentNode.classList.add(activeClass);
      }
    });
  });

  const closeSubmenus = () => {
    navItems.forEach(
      element => {
        element.classList.remove(activeClass);
      }
    );
  }

  const hoverHandler = navItem => {
    const menuTimeout = 600;
    let menuTimeoutFunction;

    navItem.addEventListener(
      'mouseenter',
      _ => {
        if (navItem.classList.contains(activeClass)) {
          clearTimeout(menuTimeoutFunction);
        } else {
          closeSubmenus();
          navItem.classList.add(activeClass);
        }
      }
    );

    navItem.addEventListener(
      'mouseleave',
      _ =>  {
        menuTimeoutFunction = setTimeout(closeSubmenus, menuTimeout);
      });
  }

  navItems.forEach(hoverHandler);
}

export const OffCanvasHandler = () => {
  const body = document.body;
  const toggle = document.querySelector('[data-menu-toggler]');
  toggle.addEventListener('click', event => {
    body.classList.toggle('menu-active');
    toggle.setAttribute('aria-expanded', body.classList.contains('menu-active').toString());
  });

  body.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && body.classList.contains('menu-active')) {
      body.classList.remove('menu-active');
      event.preventDefault();
    }
  });
}
