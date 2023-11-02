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
<table>
    <tbody>
    <tr>
        <td>ID пользователя</td>
        <td>Имя пользователя</td>
        <td>Баланс</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->balance }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
