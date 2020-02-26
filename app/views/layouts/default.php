<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scaleble=no, maximum-scale=1" />

        <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/public/css/main.css">

        <?php \project\core\base\View::getMeta() ?>

    </head>
    <body>
    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">

                <div class="col-6 text-center">
                    <a class="blog-header-logo text-dark" href="/">Задачник</a>
                </div>
                <?php if(!empty($_SESSION['user'])):?>
                <div class="col-6 pt-1 text-right">
                        <p>Вы вошли как: <?= h($_SESSION['user']['login']); ?><a href="/user/logout" onclick="" class="btn btn-sm btn-outline-secondary" style="margin-left: 6px;">Выход</a></p>

                        <a href="/main/update" style="color: red; font-weight: 600;">Редактировать задачи</a>
                </div>
                <?php else:?>
                <div class="col-2 d-flex justify-content-end align-items-center" id="enter">
                    <a class="text-muted" href="#">
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="/user/index">Вход для админа</a>
                </div>
                <?php endif; ?>
            </div>
        </header>

    </div>
    <div class="container">
        <div>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
        </div>
       <?= $content ?>
    </div>

    <footer class="blog-footer">
        <p>FOOTER</p>
    </footer>



    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/js/jquery.migrate.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/js/main.js"></script>
    </body>
</html>



