<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" id="debugModalLabel">SUCCESS</h4>
  </div>
  <div class="modal-body">
  	<p>Your Slot CODE was SAVED!</p>
    <?php
		echo $_POST['yaml'];
	?>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
  </div>
</div>