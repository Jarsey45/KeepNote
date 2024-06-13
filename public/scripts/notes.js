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
		const noteElement = getParentElement(getParentElement(this));
		const optionsElement = getParentElement(this);
		const id = noteElement.dataset.id;
		const title = noteElement.querySelector('.note-title').innerText;
		const content = noteElement.querySelector('.note-content').innerText;

		toggleClass(optionsElement, 'hidden');
		openEditNote(id, title, content);
	});
});

optionsShare.forEach((option) => {
	option.addEventListener('click', function () {
		const noteElement = getParentElement(getParentElement(this));
		const shareContainer = document.getElementById('note-share-container');
		const noteShareElement = shareContainer.querySelector('#note-share');
		const optionsElement = getParentElement(this);

		noteShareElement.dataset.id = noteElement.dataset.id;

		toggleClass(optionsElement, 'hidden');
		toggleClass(shareContainer, 'hidden');
	});
});


const updateNoteButton = document.getElementById('note-edit-submit-button');
const tintNoteEdit = document.getElementById('note-edit-tint');

updateNoteButton.addEventListener('click', function () {
	const editNote = getParentElement(this);
	const id = editNote.dataset.id;
	const title = editNote.querySelector('#note-edit-title').value;
	const content = editNote.querySelector('#note-edit-content').value;

	updateNote(id, title, content);
});

tintNoteEdit.addEventListener('click', function () {
	const parent = getParentElement(this);
	toggleClass(parent, 'hidden');
});

const shareNoteButton = document.getElementById('note-share-submit-button');
const tintNoteShare = document.getElementById('note-share-tint');

shareNoteButton.addEventListener('click', function () {
	const toShareNote = getParentElement(this);
	const id = toShareNote.dataset.id;
	const email = toShareNote.querySelector('#note-share-email').value;

	shareNote(id, email);
});

tintNoteShare.addEventListener('click', function () {
	const parent = getParentElement(this);
	toggleClass(parent, 'hidden');
});

//hide options when clicked elsewhere
document.addEventListener('click', (event) => {
	if(!(hasClass(event.target, 'note-options-container') ||
			 hasClass(event.target, 'note-options-option') ||
			 hasClass(event.target, 'note-options') ||
			 hasClass(event.target, 'icon')
		)) {
		const elementsToHide = document.querySelectorAll('.note-options-container:not(.hidden)');
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

async function updateNote(id, title, content) {
	const data = {action: 'update', data: { id, title, content }};

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

async function shareNote(id, email) {
	const data = {action: 'share', data: { id, email }};

	const request = await fetch('/shared', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	});

	const response = await request.text();
	if(response !== '1') //TODO: better response from server
		console.debug(response);
}

function openEditNote(id, title, content) { //TODO: should be queried form database
	const editContainer = document.getElementById('note-edit-container');
	const noteEditElement = editContainer.querySelector('#note-edit');
	const titleInput = editContainer.querySelector('#note-edit-title');
	const contentInput = editContainer.querySelector('#note-edit-content');

	noteEditElement.dataset.id = id;
	titleInput.value = title;
	contentInput.value = content;

	toggleClass(editContainer, 'hidden');
}