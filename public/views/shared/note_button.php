<script type="module" src="./public/scripts/note_button.js"></script>

<div id="note-button" class="flex-row-center">
  <i id="add-icon" class="fa fa-plus" aria-hidden="true"></i>
  <i id="arrow-icon" class="fa fa-arrow-left hidden" aria-hidden="true"></i>
</div>

<div id="note-add-container" class="hidden">
  <input class="title" type="text" id="note-add-title" placeholder="Your note title" maxlength="50"/>
  <textarea class="content" type="text" 
    id="note-add-content" maxlength="500" rows="50" 
    placeholder="type anything you want (●'◡'●) ..."></textarea>
</div>