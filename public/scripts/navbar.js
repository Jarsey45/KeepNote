import { toggleClass, hasClass } from "./utils.js";

const tintElement = document.querySelector('#navbar-tint');
const burgerElement = document.querySelector('#navbar-burger');

tintElement.addEventListener('click', () => {
	if(hasClass('#navbar-container', 'hidden')) return;
	toggleMenu();
});
burgerElement.addEventListener('click', toggleMenu);



function toggleMenu() {
	toggleClass('#navbar-tint', 'hidden');
	toggleClass('#navbar-container', 'hidden');
}