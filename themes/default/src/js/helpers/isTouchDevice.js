/**
 * https://stackoverflow.com/questions/4817029/whats-the-best-way-to-detect-a-touch-screen-device-using-javascript/4819886#4819886
 * @returns {boolean}
 */
export const isTouchDevice = () => {
  if ("ontouchstart" in window) return true;

  if (window.DocumentTouch && document instanceof DocumentTouch) return true;

  return window.matchMedia("(pointer: coarse)").matches;
}
