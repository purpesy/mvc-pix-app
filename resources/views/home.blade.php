<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="bg-white rounded-lg shadow p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-4">Olá, {{ auth()->user()->name }}!</h1>
        <p class="mb-6 text-gray-600">Você está logado.</p>
        <div class="flex flex-col space-y-3 mb-8">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="w-full bg-red-500 text-white p-2 rounded hover:bg-red-600">Sair da Conta</button>
            </form>
            <a href="/dashboard" class="w-full block bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Ir para Dashboard</a>
        </div>
        <hr class="my-6">
        <h2 class="text-lg font-semibold mb-2">Gerar novo PIX</h2>
        <button onclick="gerarPix()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4">Gerar PIX</button>
        <div id="pix-info" style="display: none;" class="mt-4 bg-gray-50 rounded p-4 border">
            <h3 class="font-bold mb-2">PIX Gerado:</h3>
            <p><strong>Token:</strong> <span id="token"></span></p>
            <p><strong>Status:</strong> <span id="status"></span></p>
            <p><strong>Expira em:</strong> <span id="expires_at"></span></p>
            <p><strong>Link:</strong> <a id="pix-link" href="#" target="_blank" class="text-blue-600 underline"></a></p>
        </div>
    </div>
    <script>
        async function gerarPix() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/pix', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            });
            if (response.ok) {
                const data = await response.json();
                document.getElementById('pix-info').style.display = 'block';
                document.getElementById('token').textContent = data.token;
                document.getElementById('status').textContent = data.status;
                document.getElementById('expires_at').textContent = new Date(data.expires_at).toLocaleString();
                document.getElementById('pix-link').href = data.link;
                document.getElementById('pix-link').textContent = data.link;
            } else {
                alert('Erro ao gerar PIX. Tente novamente.');
            }
        }
    </script>
</body>
</html>
