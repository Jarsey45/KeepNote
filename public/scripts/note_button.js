import { getInputContent, hasClass, setInputValue, toggleClass } from "./utils.js";

const noteAddButton = document.querySelector('#note-button');
const noteAddTitle = document.querySelector('#note-add-container #note-add-title');
const noteAddContent = document.querySelector('#note-add-container #note-add-content');

noteAddButton.addEventListener('click', () => {

  if(!hasClass('#note-add-container', 'hidden')) {
    const title = getInputContent(noteAddTitle);
    const content = getInputContent(noteAddContent);
    console.log(title, content);


    setInputValue(noteAddTitle);
    setInputValue(noteAddContent);
  }

  toggleClass('#note-add-container', 'hidden');
  toggleClass('#note-button #arrow-icon', 'hidden');
  toggleClass('#note-button #add-icon', 'hidden');
});