
const logoutButton = document.getElementById('logout-button');

logoutButton.addEventListener('click', () => {
  logout();
});



async function logout() { 
  const data = {action: 'log_out'};

	const request = await fetch('/account_user', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	});

	const response = await request.text();
	if(response !== '1') //TODO: better response from server
		window.location.assign('/login');
	else
		console.debug(response);
}