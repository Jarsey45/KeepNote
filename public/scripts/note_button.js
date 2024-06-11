import { getInputContent, hasClass, setInputValue, toggleClass } from "./utils.js";

const noteAddButton = document.querySelector('#note-button');
const noteAddTitle = document.querySelector('#note-add-container #note-add-title');
const noteAddContent = document.querySelector('#note-add-container #note-add-content');

noteAddButton.addEventListener('click', async () => {

	if(!hasClass('#note-add-container', 'hidden')) {
		const title = getInputContent(noteAddTitle);
		const content = getInputContent(noteAddContent);

		setInputValue(noteAddTitle);
		setInputValue(noteAddContent);

		await addNote(title, content);
	}

	toggleClass('#note-add-container', 'hidden');
	toggleClass('#note-button #arrow-icon', 'hidden');
	toggleClass('#note-button #add-icon', 'hidden');
});

async function addNote(title, content) {
	if(title.length < 1 || content.length < 1) return;
	const data = {action: 'insert', data: { title, content }};

	const request = await fetch('/notes', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	});

	const response = await request.text();
	console.log(response);
	if(response === '1') //TODO: better response from server
		window.location.reload();
	else
		console.debug(response);
}