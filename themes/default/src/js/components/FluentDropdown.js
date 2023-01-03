export const FluentDropdown = () => {
  const fluentButton = document.querySelector('.fluent__button');
  const fluentList = document.querySelector('.fluent__list');

  fluentButton.addEventListener('click', () => {
    fluentList.classList.toggle('fluent__list--hidden');
  })
}
