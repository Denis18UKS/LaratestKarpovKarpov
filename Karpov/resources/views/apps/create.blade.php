<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Создать заявку</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
    <h1>Создать заявку</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif


    <div>
        <form action="{{route('logout')}}">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    </div>

    <form action="{{ route('apps.stores') }}" method="POST">
        @csrf
        <select name="service_type" id="service_type">
            <option value="general_clearing">Генеральная уборка</option>
            <option value="clearing_posle_remonta">Уборка после ремонта</option>
            <option value="clearing_office">Уборка офиса</option>
        </select>

        <label for="date_time">Дата и время</label>
        <input type="date" name="date_time" id="date_time" required>

        <label for="address">Адрес</label>
        <input type="text" name="address" id="address" required>

        <button type="submit">Создать</button>
    </form>


</body>

</html>