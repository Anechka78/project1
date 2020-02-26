<div class="container">

<h1>Авторизация</h1>

    <form action="/user/login/" method="post">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="login" id="login" value="" placeholder="Введите логин" required>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Введите пароль" required>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <button type="submit" id="login" class="btn-sm btn-outline-secondary" style="margin-left: 15px;">Авторизоваться</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    </br>

</div>