<script type="module" src="./public/scripts/accounts_manage.js"></script>

<div id="app-content">
  <div id="table">
    <div id="table-header">
      <div class="table-cell">ID</div>
      <div class="table-cell">Username</div>
      <div class="table-cell">Email</div>
      <div class="table-cell">Join date</div>
      <div class="table-cell">Delete?</div>
    </div>
    <?php
    foreach($users as $user):
      if($user->getRole() !== Roles::ADMIN):
    ?>
      <div class="table-row" data-id="<?=$user->getId()?>">
        <div class="table-cell"><?=$user->getId()?></div>
        <div class="table-cell"><?=$user->getUsername()?></div>
        <div class="table-cell"><?=$user->getEmail()?></div>
        <div class="table-cell"><?=$user->getDateCreated()?></div>
        <div class="table-cell"><i class="icon delete-button fa fa-times" aria-hidden="true"></i></div>
      </div>
    <?php
      endif;
    endforeach;
     ?>
  </div>
</div>