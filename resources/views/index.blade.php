<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo ao seu Dashboard</h1>

    <ul>
        <li><strong>Gerados:</strong> {{ $generated }}</li>
        <li><strong>Pagos:</strong> {{ $paid }}</li>
        <li><strong>Expirados:</strong> {{ $expired }}</li>
    </ul>
</body>
</html>
