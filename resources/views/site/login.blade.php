<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style type="text/css">
        .login-form-block {
            padding-top: 30px;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/">
        JcBaza.ru
    </a>
</nav>
<div class="container">
    <div class="row login-form-block">
        <div class="col-md-6 col-lg-4">
            <h4 class="pb-4">Вход в личный кабинет</h4>
            <form action="login" method="POST">
             {{ csrf_field() }}
                <div class="form-group">
                    <input
                            type="email"
                            name="email"
                            class="form-control form-control-md"
                            id="authEmail"
                            placeholder="Почта"
                            value="{{ old("email") }}"
                            required="required"
                    />
                </div>
                <div class="form-group">
                    <input
                            type="password"
                            name="password"
                            class="form-control form-control-md"
                            id="authPassword"
                            placeholder="Пароль"
                            required="required"
                    />
                </div>
                <button type="submit" class="btn btn-primary w-100">Войти</button>
            </form>
            @if(!empty($errors->any()))
                <div class="alert alert-danger mt-3" role="alert">
                    <ul style="text-align:left">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="pt-4">
                <h5><a href="">Зарегистрироваться</a></h5>
                <h5><a href="">Восстановить пароль</a></h5>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>