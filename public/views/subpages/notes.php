<div id="notes-container">
  <?php 
  $n = 25;
  for($i = 1; $i <= $n; $i++):
    include VIEWS_PATH . 'components/note.php';
  endfor;
  ?>
</div>