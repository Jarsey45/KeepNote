/**
 * Finds target element  and toggles class
 * @param {string} target query selector of target
 * @param {string} className class to toggle
 * @returns {void}
 */
export function toggleClass(target, className) {
  const element = document.querySelector(target);
  if(element === null) return;

  element.classList.toggle(className);
}

/**
 * Checks if element has certain class
 * @param {string} target query selector of target 
 * @param {string} className class to chec 
 * @returns {boolean} true if element has class, false otherwise
 */
export function hasClass(target, className) {
  const element = document.querySelector(target);
  if(element === null) return false;

  return element.classList.contains(className);
}

/**
 * Returns trimmed value of element 
 * @param {HTMLInputElement|HTMLTextAreaElement|string} element can be querySelector or HTML element
 * @returns {string} value of input or textarea
 */
export function getInputContent(element) {
  if(typeof element === 'string')
    element = document.querySelector(element); 
  return element.value.trim();
}

/**
 * Set value of input or textarea
 * @param {HTMLInputElement|HTMLTextAreaElement|string} element can be querySelector or HTML element
 * @param {string} value 
 */
export function setInputValue(element, value = '') {
  if(typeof element === 'string')
    element = document.querySelector(element);
  element.value = value;
}