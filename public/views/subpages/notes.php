<div id="notes-container">
  <?php
  foreach($notes as $note):
    include VIEWS_PATH . 'components/note.php';
  endforeach;
  ?>
</div>

<?php include VIEWS_PATH . 'shared/note_button.php'; ?>