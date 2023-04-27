<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Авторизация</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    </head>
<body>
    <div class="table" id="auth-layout">
        <div class="table-row">
            <div class="table-cell" id="auth">
                <div class="auth-form-title">Авторизация</div>
                <div class="auth-form tabs">
                    <ul class="tabs-list">
                        <li><a href={{route('index')}}><i class="fa fa-home"></i></a></li>
                        <li class="tab active" data-key="login">Вход</li>
                        <li class="tab" data-key="register">Регистрация</li>
                        <div class="tabs-line tabs-line-login"></div>
                    </ul>
                    <div class="tab-content tab-content-show" data-key="login">
                        <form method="POST" action={{route('login')}}>
                            <div class="form-subtitle">Вход по номеру телефона</div>
                            @csrf
                            <div class="form-field">
                                <div class="form-input-wrap">
                                    <input type="text" name="phone" value class="form-input form-input-icon phone-input" maxlength="10" placeholder="Телефон">
                                <span class="form-field-icon"><i class="fa fa-user"></i></span>
                                <span class="phone-code">+7 </span>
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-input-wrap">
                                    <input type="password" name="password" value class="form-input form-input-icon" placeholder="Пароль">
                                <span class="form-field-icon"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="input-checkbox">
                                    <input checked="checked" type="checkbox" id="remember">
                                    <label for="remember">
                                        <span></span>
                                        Запомнить меня
                                    </label>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="primary-btn" button-primary-button>Войти</button>
                            </div>
                        </form>
                        <div class="auth-footer">
                            <span class="auth-footer-label">Вы забыли пароль?</span>
                            <a href="#"> Восстановить</a>
                        </div>
                    </div>
                    <div class="tab-content" data-key="register">
                        <form method="POST" action={{route('register')}}>
                            @csrf
                            <div class="form-field">
                                <div class="form-input-wrap">
                                    <input type="text" name="phone" value class="form-input form-input-icon phone-input" maxlength="10" placeholder="Телефон">
                                <span class="form-field-icon"><i class="fa fa-user"></i></span>
                                <span class="phone-code">+7 </span>
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-input-wrap">
                                    <input type="password" name="password" value class="form-input form-input-icon" placeholder="Пароль">
                                <span class="form-field-icon"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-input-wrap">
                                    <input type="password" name="confirm-password" value class="form-input form-input-icon" placeholder="Пароль">
                                <span class="form-field-icon"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="primary-btn" button-primary-button>Зарегистрироваться</button>
                            </div>
                        </form>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Plugins -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>