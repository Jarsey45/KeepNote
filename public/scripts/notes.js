import { toggleClass, hasClass, getParentElement } from "./utils.js";

const noteOptionElements = document.querySelectorAll('.note-options');

noteOptionElements.forEach((el) => {
  el.addEventListener('click', function () {
    const parent = getParentElement(this);
    const optionsContainer = parent.querySelector('.note-options-container');

    toggleClass(optionsContainer, 'hidden');
  });
});

const optionsEdit = document.querySelectorAll('.note-options-container .note-options-option.edit');
const optionsShare = document.querySelectorAll('.note-options-container .note-options-option.share');
const optionsDelete = document.querySelectorAll('.note-options-container .note-options-option.delete');

optionsDelete.forEach((option) => {
  option.addEventListener('click', function () {
    const parent = getParentElement(getParentElement(this));
    console.log(parent.dataSet);
    const id = parent.dataset.id;
    deleteNote(id);
  });
});


async function deleteNote(id) {
  console.log(id);
}