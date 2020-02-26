<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Таблица задач</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-12" style="margin-bottom:15px; ">
                <btn class="btn btn-sm btn-success" id="add_new_task">Добавить задачу</btn>
            </div>

            <div class="box" id="add_task_box" style="display: none;">
                <form action="/main/add" method="post">
                    <!-- box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            <select name="user_name" id="user_name" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option class="user" value="0">Выберите пользователя</option>
                                <?php foreach($users as $k=>$v):?>
                                    <option id="<?= h($v['id']);?>" data-email="<?= h($v['email']);?>" class="property_name" value="<?= h($v['name']);?>"><?= h($v['name']);?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add_task_user_email">Email</label>
                            <input type="text" name="add_task_user_email" id="add_task_user_email" class="form-control" value="" readonly="readonly" >
                        </div>
                        <div class="form-group">
                            <textarea name="add_task_desk" cols="80" rows="10" placeholder="Описание задачи"></textarea>
                        </div>
                    </div>
                    <div class="box-footer" style="margin-bottom: 15px;">
                        <button type="submit" class="btn btn-success">Поставить задачу</button>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.box -->

            <table id="" class="table table-bordered table-striped">
                <thead>
                <tr class="sort">
                    <th><img class="sort-top"  data-val="id" >ID записи</th>
                    <th><a href="/?sort=name&order=ASC"><img class="sort-top"  data-val="name" data-dir="ASC" src="/images/sort_top.png" ></a>Имя пользователя<a href="/?sort=name&order=DESC"><img  data-val="name" data-dir="DESC" src="/images/sort_bottom.png" img class="sort-bottom"></a></th>
                    <th><a href="/?sort=email&order=ASC"><img class="sort-top"  data-val="email" data-dir="ASC" src="/images/sort_top.png" ></a>E-mail<a href="/?sort=email&order=DESC"><img  data-val="email" data-dir="DESC" src="/images/sort_bottom.png" img class="sort-bottom"></a></th>
                    <th>Задача</th>
                    <th><a href="/?sort=status&order=ASC"><img class="sort-top"  data-val="status" data-dir="ASC" src="/images/sort_top.png" ></a>Статус<a href="/?sort=status&order=DESC"><img  data-val="status" data-dir="DESC" src="/images/sort_bottom.png" img class="sort-bottom"></a></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id']?></td>
                        <td><?= $task['name']?></td>
                        <td><?= $task['email'];?></td>
                        <td><?= $task['task']?></td>
                        <td><?= $task['status'] ? 'Отредактировано администратором': 'В работе';?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID записи</th>
                    <th>Имя пользователя</th>
                    <th>E-mail</th>
                    <th>Задача</th>
                    <th>Статус</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-center">
            <p>Показано <?=count($tasks);?> задачи из <?= $total;?></p>
            <?php if($pagination->countPages > 1):?>
                <?= $pagination; ?>
            <?php endif; ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>