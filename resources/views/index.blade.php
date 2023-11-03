<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>balance-transfer</title>
</head>
<body>
<style>
    table, th, td {
        border: 1px solid #1d2124;
    }
</style>

<h1>balance-transfer</h1>

<h2>Список всех пользователей</h2>

<table>
    <tbody>
    <tr>
        <td>ID пользователя</td>
        <td>Имя пользователя</td>
        <td>Баланс</td>
        <td>Дата и время последнего перевода</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->balance }}</td>
            <td>{{ $user->transactions_created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h2>Создать отложенный перевод</h2>

<form action="{{ route('transfers.create') }}" method="POST">
    @csrf

    <label>От кого (ID пользователя):</label>
    <input required type="number" name="from_user_id" value="">
    <br />

    <label>Кому (ID пользователя):</label>
    <input required type="number" name="to_user_id" value="">
    <br />

    <label>Сумма перевода:</label>
    <input required type="number" name="money" value="">
    <br />

    <label>Запланировать дату:</label>
    <input required type="datetime-local" name="date" value="">
    <br />

    <button>Запланировать</button>
</form>

</body>
</html>
