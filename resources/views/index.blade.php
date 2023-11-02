<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>balance-transfer</title>
</head>
<body>
<ul>
    @foreach($users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>
</body>
</html>
