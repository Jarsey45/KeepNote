<script type="module" src="./public/scripts/notes.js"></script>

<div id="notes-container">
	<?php
	foreach($notes as $note):
		include VIEWS_PATH . 'components/note.php';
	endforeach;
	?>
</div>

<div id="note-edit-container" class="hidden">
	<div id="note-edit">
		<input type="text" id="note-edit-title" placeholder="Your note title" maxlength="50"/>
		<textarea type="text" 
			id="note-edit-content" maxlength="500" rows="50" 
			placeholder="type anything you want (●'◡'●) ..."></textarea>
		<div id="note-edit-submit-button" class="flex-row-center"><i id="arrow-icon" class="fa fa-arrow-left hidden" aria-hidden="true"></i></div>
	</div>
	<div id="note-edit-tint"></div>
</div>

<div id="note-share-container" class="hidden">
	<div id="note-share">
		<input type="email" id="note-share-email" placeholder="Email of user" maxlength="50"/>
		<div id="note-share-submit-button" class="flex-row-center"><i id="arrow-icon" class="fa fa-arrow-left hidden" aria-hidden="true"></i></div>
	</div>
	<div id="note-share-tint"></div>
</div>

<?php include VIEWS_PATH . 'shared/note_button.php'; ?>