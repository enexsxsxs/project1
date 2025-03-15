<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Авторизация</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #9BAEEF, #CDD8FF);
            font-family: "Playfair Display", serif;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4A5568;
            margin-bottom: 30px;
        }
        .form-label {
            color: #4A5568;
            font-weight: 600;
        }
        .form-control {
            border: 2px solid #E2E8F0;
            border-radius: 8px;
            padding: 10px 15px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #3A314E;
            box-shadow: 0 0 0 3px rgba(205, 216, 255, 0.25);
        }
        .input-group-text {
            cursor: pointer;
            background-color: #F7FAFC;
            border: 2px solid #E2E8F0;
            border-left: none;
            color: #4A5568;
        }
        .btn-primary {
            background-color: #CDD8FF;
            border: none;
            color: #4A5568;
            font-weight: 600;
            padding: 12px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #B0C4DE;
        }
        .alert-danger {
            background-color: #FED7D7;
            border-color: #FEB2B2;
            color: #9B2C2C;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-danger ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
        a {
            color: #4A5568;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center">Авторизация</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="input-group-text" id="togglePassword">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Войти</button>
    </form>

    <div class="mt-3 text-center">
        <span>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></span>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            const passwordField = $('#password');
            const passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordField.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
</script>
</body>
</html>
