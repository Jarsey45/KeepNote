<script type="module" src="./public/scripts/account.js"></script>

<div id="account-info-container" class="note">
	<div class="note-row">
		<div id="account-basic-info" class="note">
			<div class="title">Basic information</div>
			<div class="row">
				<div class="subtitle">Nickname</div>
				<div class="content"><?=$user->getUsername()?></div>
			</div>
			<div class="row">
				<div class="subtitle">E-Mail</div>
				<div class="content"><?=$user->getEmail()?></div>
			</div>
		</div>
		<div id="account-share-stats" class="note">
			<div class="title">Sharing Statistics &lt;3</div>
			<div class="row">
				<div class="subtitle">Shared</div>
				<div class="content">0</div>
			</div>
			<div class="row">
				<div class="subtitle">Received</div>
				<div class="content">2</div>
			</div>
		</div>
	</div>
	<div class="note-row">
		<div id="credits-help" class="note">
			<div class="title">Credits and Help</div>
			<div class="row">
				<div class="subtitle">Contact</div>
				<div class="content">support@keepnote.com</div>
			</div>
			<div class="row-buttons">
				<button type="button" class="button" id="reset-button">Reset Password</button>
				<button type="button" class="button" id="delete-button">Delete Account</button>
				<button type="button" class="button" id="logout-button">Log Out</button>
			</div>
		</div>
	</div>
</div>