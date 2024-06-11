<script type="module" src="./public/scripts/notes.js"></script>

<div id="notes-container">
	<?php
	foreach($shared_notes as $username => $data): 
	?>
		<div class="notes-shared">
			<div class="notes-shared-title"><?=$username?></div>
			<?php
			foreach($data as $note):
				include VIEWS_PATH . 'components/note.php';
			endforeach;
			?>
		</div>
	<?php
	endforeach;
	?>
</div>

<?php include VIEWS_PATH . 'shared/note_button.php'; ?>