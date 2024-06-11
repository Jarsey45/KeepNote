/**
 * Finds target element  and toggles class
 * @param {string|HTMLElement} target query selector of target
 * @param {string} className class to toggle
 * @returns {void}
 */
export function toggleClass(target, className) {
	if(target instanceof HTMLElement) { 
		target.classList.toggle(className);
		return;
	}

	const element = document.querySelector(target);
	if(element === null) return;

	element.classList.toggle(className);
}

/**
 * Finds target element  and toggles class
 * @param {string|HTMLElement} target query selector of target
 * @param {string} className class to toggle
 * @param {bool} value should class be removed or added
 * @returns {void}
 */
export function changeClass(target, className, value) {
	if(target instanceof HTMLElement) {
		if(value)
			target.classList.add(className);
		else
			target.classList.remove(className);
		return;
	}

	const element = document.querySelector(target);
	if(element === null) return;

	if(value)
		element.classList.add(className);
	else
		element.classList.remove(className);
}

/**
 * Checks if element has certain class
 * @param {HTMLElement|string} target query selector of target or HTML element
 * @param {string} className class to chec 
 * @returns {boolean} true if element has class, false otherwise
 */
export function hasClass(target, className) {
	if(target instanceof HTMLElement)
		return target.classList.contains(className);

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

/**
 * Get parent element
 * @param {HTMLElement} element child element
 * @returns {ParentNode|null}
 */
export function getParentElement(element) {
	if (!element || !element.parentNode) {
		return null;
	}
	return element.parentNode;
}