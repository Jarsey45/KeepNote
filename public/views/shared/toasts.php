<div id="toasts-container">
  <?php
  foreach($messages as $message) {
    include VIEWS_PATH . 'components/toast.php';
  }
  ?>
</div>