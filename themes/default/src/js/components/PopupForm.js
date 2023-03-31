
const PopupForm = _ => {
  const popup = document.querySelector('[data-popup-form-holder]');
  const toggles = document.querySelectorAll('[data-toggle-popup-form]');
  const container = document.querySelector('[data-popup-form-container]');

  if (!popup) return;

  const toggleActive = _ => popup.classList.toggle('active');

  toggles.forEach(toggle => toggle.addEventListener('click', toggleActive))

  const _bindEvents = () => container.querySelector('form')?.addEventListener('submit', _handleFormSubmission);

  const _handleFormSubmission = event => {
    event.preventDefault();
    const form = container.querySelector('form');
    const url = form.getAttribute('action');
    const body = new FormData(event.target);
    fetch(url, {
      method: 'POST',
      body
    })
    .then(response => response.ok ? response.text() : Promise.reject(response))
    .then(data => {
      container.innerHTML = data;
      _bindEvents();
    })
    .catch(error => {
      console.warn(error);
    });
  }

  _bindEvents();
}

export default PopupForm;
