<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Заявки</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <h1>Заявки</h1>

    @if (session('success'))
        <p>{{session('success')}}</p>
    @endif

    <div>
        <a href="{{route('apps.create')}}">Создать заявку</a>
        <form action="{{route('logout')}}">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    </div>

    <table>
        <thead>
            <th>Тип услуги</th>
            <th>Дата и время выполнения</th>
            <th>Адрес</th>
            <th>ФИО пользователя</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($apps as $app)
                <tr>
                    <td>{{$app->service_type}}</td>
                    <td>{{$app->date_time}}</td>
                    <td>{{$app->address}}</td>
                    <td>
                        @if (Auth::user()->role === 'admin')
                            <form action="{{route('apps.status')}}">
                                @csrf
                                @method('PATCH')
                                <select name="status" id="status">
                                    <option value="new" @if ($app->status === 'new') selected @endif>Новая</option>
                                    <option value="success" @if ($app->status === 'success') selected @endif>Принять</option>
                                    <option value="declaimed" @if ($app->status === 'declaimed') selected @endif>Отклонить
                                    </option>
                                </select>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>