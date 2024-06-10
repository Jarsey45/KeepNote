<div class="note <?=$note->getColor()?>" data-id="<?=$note->getId();?>">
  <div class="note-title"><?=$note->getTitle()?></div>
  <div class="note-options"><i class="icon fa fa-ellipsis-h" aria-hidden="true"></i></div>
  <div class="note-content"><?=$note->getContent()?></div>
  <div class="note-date"><?=$note->getDateCreated()?></div>
  <div class="note-options-container hidden">
    <div class="note-options-option share">share</div>
    <div class="note-options-option edit">edit</div>
    <div class="note-options-option delete">delete</div>
  </div>
</div>