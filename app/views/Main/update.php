<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Таблица редактирования задач</h3>
        </div>

            <table id="" class="table table-bordered table-striped">
                <thead>
                <tr class="sort">
                    <th>№</th>
                    <th style="width: 200px;"><a href="/main/update/?sort=user_name&order=ASC"><img class="sort-top"  data-val="name" data-dir="ASC" src="/images/sort_top.png" ></a>Пользователь<a href="/main/update/?sort=user_name&order=DESC"><img  data-val="name" data-dir="DESC" src="/images/sort_bottom.png" img class="sort-bottom"></a></th>
                    <th style="width: 100px;"><a href="/main/update/?sort=user_email&order=ASC"><img class="sort-top"  data-val="email" data-dir="ASC" src="/images/sort_top.png" ></a>E-mail<a href="/main/update/?sort=user_email&order=DESC"><img  data-val="email" data-dir="DESC" src="/images/sort_bottom.png" img class="sort-bottom"></a></th>
                    <th >Задача</th>
                    <th style="width: 100px;"><a href="/main/update/?sort=status&order=ASC"><img class="sort-top"  data-val="status" data-dir="ASC" src="/images/sort_top.png" ></a>Статус<a href="/main/update/?sort=status&order=DESC"><img  data-val="status" data-dir="DESC" src="/images/sort_bottom.png" img class="sort-bottom"></a></th>
                    <th style="width: 100px;">Редактировать</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id']?></td>
                        <td><?= $task['user_name']?></td>
                        <td><?= $task['user_email'];?></td>
                        <td><?= $task['task']?></td>
                        <td><?= $task['status'] ? 'Выполнено': '';?></br>
                            <?= $task['edit'] ? 'Отредактировано администратором': '';?></td>
                        <td><a href="/task/index?id=<?=$task['id'];?>"><svg class="bi bi-tools" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd"/></svg></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>№</th>
                    <th>Пользователь</th>
                    <th>E-mail</th>
                    <th>Задача</th>
                    <th>Статус</th>
                    <th>Редактировать</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-center">
            <p>Показано <?=count($tasks);?> задач из <?= $total;?></p>
            <?php if($pagination->countPages > 1):?>
                <?= $pagination; ?>
            <?php endif; ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->




</section>