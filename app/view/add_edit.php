<div class="alert alert-info add-edit-info" role="alert">
  <?= isset($task) ? 'Editing task #'.$task['task_id'] : 'Adding a new task'; ?>
</div>

<div class="clearfix"></div>

<form id="add-edit-form" action="/tasks/save" method="post">
  <? if(isset($task)) { ?>
    <input type="hidden" name="task_id" value="<?= $task ? $task['task_id'] : '';?>">
  <? } ?>

  <div class="form-group">
    <label for="user_name">Name</label>
    <input type="text" name="user_name" value="<?= isset($task) ? screen($task['user_name']) : ''; ?>" minlength="2" required>
  </div>

  <div class="form-group">
    <label for="user_email">E-mail</label>
    <input type="email" name="user_email" value="<?= isset($task) ? screen($task['user_email']) : ''; ?>" required>
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" cols="50" rows="1" required><?= isset($task) ? screen($task['description']) : ''; ?></textarea>
  </div>

  <div class="buttons">
    <a class="btn btn-secondary btn-sm" href="/tasks/main">Cancel</a>
    <a class="btn btn-info preview-button btn-sm" href="#">Preview</a>
    <input class="btn btn-primary btn-sm" type="submit" value="<?= isset($task) ? 'Save' : 'Add'; ?>">
  </div>
  
</form>

<table id="preview">
  <thead>
    <th>Name</th>
    <th>E-mail</th>
    <th>Description</th>
    <th width="1%">Status</th>

  </thead>
  <tbody>
    <tr t_id="<?=$task['task_id']?>">
      <td></td>
      <td></td>
      <td></td>
      <td>
        <span class="badge badge-light">In process..</span>
      </td>
    </tr>
  </tbody>
</table>


<script>

  $(function() {
    $('.preview-button').on("click", function(){
      /* Запись данных */
      $('#preview tr td:eq(0)').html($('input[name=user_name]').val());
      $('#preview tr td:eq(1)').html($('input[name=user_email]').val());
      $('#preview tr td:eq(2)').html($('textarea[name=description]').val());

      /* Показать */
      $('#preview').show();

    });
  });
</script>