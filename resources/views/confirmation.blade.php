<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Pagamento PIX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    @php
        $statusMap = [
            'paid' => [
                'label' => 'Pago',
                'color' => 'text-green-600',
                'bg' => 'bg-green-100',
                'icon' => '✅',
                'message' => 'Pagamento confirmado com sucesso!'
            ],
            'expired' => [
                'label' => 'Expirado',
                'color' => 'text-red-600',
                'bg' => 'bg-red-100',
                'icon' => '⏰',
                'message' => 'PIX expirado. Gere um novo para pagar.'
            ],
            'generated' => [
                'label' => 'Gerado',
                'color' => 'text-blue-600',
                'bg' => 'bg-blue-100',
                'icon' => '📄',
                'message' => 'PIX ainda aguardando pagamento.'
            ],
        ];
        $statusInfo = $statusMap[$pix->status] ?? $statusMap['generated'];
    @endphp

    <div class="w-full max-w-md {{ $statusInfo['bg'] }} rounded-xl shadow-xl p-8 text-center">
        <div class="text-4xl mb-4">{{ $statusInfo['icon'] }}</div>
        <h1 class="text-2xl font-bold mb-2 {{ $statusInfo['color'] }}">
            Status: {{ $statusInfo['label'] }}
        </h1>

        <p class="text-sm mb-1"><strong>Token:</strong> {{ $pix->token }}</p>
        <p class="text-sm mb-4"><strong>Expira em:</strong> {{ \Carbon\Carbon::parse($pix->expires_at)->format('d/m/Y H:i:s') }}</p>

        <div id="qrcode" class="flex justify-center my-4"></div>

        <div class="mt-4 font-medium {{ $statusInfo['color'] }}">
            {{ $statusInfo['message'] }}
        </div>
    </div>

    <script>
        QRCode.toCanvas(document.getElementById('qrcode'), "{{ url('/pix/' . $pix->token) }}", {
            width: 200,
            margin: 1,
            color: {
                dark: '#1f2937',
                light: '#ffffff'
            }
        });
    </script>
</body>
</html>
