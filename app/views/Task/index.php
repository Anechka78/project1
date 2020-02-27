<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Редактирование задачи № <?= $task['id']; ?></h3>
        </div>
    </div>
    <!-- /.box -->

    <form action="/task/update?id=<?= $task['id']?>" method="post">
        <div class="form-group">
            <p>Пользователь:</p>
            <input type="text" name="user_name" class="form-control" value="<?= h($task['user_name']); ?>" readonly="readonly" >
        </div>
        <div class="form-group">
            <p>E-mail пользователя:</p>
            <input type="text" name="user_email" class="form-control" value="<?= h($task['user_email']); ?>" readonly="readonly" >
        </div>
        <div class="form-group">
            <p>Поставленная задача:</p>
            <textarea name="task" cols="80" rows="10"><?= h($task['task']); ?></textarea>
        </div>
        <div class="form-group">
            <input value="<?= $task['id']?>" id="task_checkbox" type="checkbox" name="status" <?= $task['status'] ? ' checked' : null; ?>> Отметить выполненной
        </div>
        <div class="box-footer" style="margin-bottom: 15px;">
            <button type="submit" class="btn btn-success">Сохранить изменения</button>
        </div>
    </form>
</section>