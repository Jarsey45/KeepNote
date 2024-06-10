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
    const id = parent.dataset.id;
    deleteNote(id);
  });
});

optionsEdit.forEach((option) => {
  option.addEventListener('click', function () {
    
  });
});

optionsShare.forEach((option) => {
  option.addEventListener('click', function () {
    
  });
});

//hide options when clicked elsewhere
document.addEventListener('click', (event) => {
  console.log(event.target);
  if(!(hasClass(event.target, 'note-options-container') ||
       hasClass(event.target, 'note-options-option') ||
       hasClass(event.target, 'note-options') ||
       hasClass(event.target, 'note-options icon')
    )) {
    const elementsToHide = document.querySelectorAll('.note-options-container:not(.hidden)');
    console.log(elementsToHide);
    elementsToHide.forEach((el) => {
      toggleClass(el, 'hidden');
    });
  }
})


async function deleteNote(id) {
  const data = {action: 'delete', data: { id }};

  const request = await fetch('/notes', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  });

  const response = await request.text();
  if(response === '1') //TODO: better response from server
    window.location.reload();
  else
    console.debug(response);
}