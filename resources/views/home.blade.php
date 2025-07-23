<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Olá, {{ auth()->user()->name }}!</h1>

    <p>Você está logado.</p>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    <h2>Gerar novo PIX</h2>
    <button onclick="gerarPix()">Gerar PIX</button>

    <div id="pix-info" style="margin-top: 20px; display: none;">
        <h3>PIX Gerado:</h3>
        <p><strong>Token:</strong> <span id="token"></span></p>
        <p><strong>Status:</strong> <span id="status"></span></p>
        <p><strong>Expira em:</strong> <span id="expires_at"></span></p>
        <p><strong>Link:</strong> <a id="pix-link" href="#" target="_blank"></a></p>
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
