<!-- update modal -->
<div class="modal fade" id="edit_<?= $i->id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Update Student Record</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="todolist.php?id=<?= $i->id ?>">
        <div class="form-group">
        <!-- FORM -->
          <label for="todolist">First Name:</label>
          <input type="text" name="todolist" id="" class="form-control" value="<?= $i->todolist; ?>">
          <span class="error">*<?= $todolist_err?></span>
        </div>
 
        <div class="form-group">
          <button type="submit" class="btn btn-info" name="edit">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <!--button name is important it will be used to check if the user triggered update:name="execute_update"-->
        </div>
      </form>
      </div>
    </div>
  </div>
</div>