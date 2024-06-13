
const deleteButtons = document.querySelectorAll('.delete-button');

deleteButtons.forEach((el) => {
  el.addEventListener('click', function () {
    const parent = el.parentNode.parentNode;
    const id = parent.dataset.id;
    deleteUser(id);
  });
});

async function deleteUser(id) {
  const data = {action: 'delete', data: { id }};

	const request = await fetch('/account_admin', {
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