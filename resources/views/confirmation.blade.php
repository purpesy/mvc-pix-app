<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Confirmação de Pagamento PIX</title>
</head>

<body>
    @php
    $statusTraduzido = [
    'paid' => 'Pago',
    'expired' => 'Expirado',
    'generated' => 'Gerado',
    ][$pix->status] ?? ucfirst($pix->status);
    @endphp

    <h1>Status: {{ $statusTraduzido }}</h1>

    <p><strong>Token:</strong> {{ $pix->token }}</p>
    <p><strong>Expiração:</strong> {{ $pix->expires_at }}</p>
</body>

</html>