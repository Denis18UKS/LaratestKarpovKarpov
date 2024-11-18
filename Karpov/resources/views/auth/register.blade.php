<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Регистрация</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <a href="{{route('auth.login')}}">Вход</a>
    <h1>Регистрация</h1>
    <form action="{{route('auth.regProc')}}" method="POST">
        @csrf
        <label for="full_name">ФИО:</label>
        <input type="text" name="full_name" id="full_name">

        <label for="phone">Телефон:</label>
        <input type="tel" name="phone" id="phone">

        <label for="login">Логин:</label>
        <input type="text" name="login" id="login">

        <label for="email">Почта:</label>
        <input type="email" name="email" id="email">

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password">

        <button type="submit">Регистрация</button>
    </form>
</body>

</html>