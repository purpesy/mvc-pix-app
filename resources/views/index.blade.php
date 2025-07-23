<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow p-8 mt-8">
        <div class="flex justify-between mb-6">
            <div class="flex space-x-2">
                <a href="/home" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Voltar para Home</a>
            </div>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Sair</button>
            </form>
        </div>
        <h1 class="text-3xl font-bold mb-8 text-center">Bem-vindo ao seu Dashboard</h1>
        <div class="flex space-x-8 mb-8 justify-center">
            <div class="bg-blue-200 rounded-lg shadow p-6 w-48 text-center">
                <div class="text-2xl font-bold text-blue-800">{{ $generated }}</div>
                <div class="text-lg text-blue-600">Gerados</div>
            </div>
            <div class="bg-green-200 rounded-lg shadow p-6 w-48 text-center">
                <div class="text-2xl font-bold text-green-800">{{ $paid }}</div>
                <div class="text-lg text-green-600">Pagos</div>
            </div>
            <div class="bg-red-200 rounded-lg shadow p-6 w-48 text-center">
                <div class="text-2xl font-bold text-red-800">{{ $expired }}</div>
                <div class="text-lg text-red-600">Expirados</div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4 text-center">Distribuição dos PIX</h2>
                <canvas id="pixChart" width="300" height="300"></canvas>
            </div>
            <div class="bg-gray-50 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4 text-center">PIX por Status (Barra)</h2>
                <canvas id="barChart" width="300" height="300"></canvas>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('pixChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Gerados', 'Pagos', 'Expirados'],
                datasets: [{
                    data: [{{ $generated }}, {{ $paid }}, {{ $expired }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: false }
                }
            }
        });
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Gerados', 'Pagos', 'Expirados'],
                datasets: [{
                    label: 'Quantidade',
                    data: [{{ $generated }}, {{ $paid }}, {{ $expired }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
