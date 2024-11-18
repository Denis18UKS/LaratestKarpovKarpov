<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Вход</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
    <a href="{{route('auth.register')}}">Регистрация</a>
    <h1>Вход</h1>
    <form action="{{route('auth.loginProc')}}" method="POST">
        @csrf
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login">

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password">

        <button type="submit">Вход</button>
    </form>
</body>

</html>