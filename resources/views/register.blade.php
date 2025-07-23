<!DOCTYPE html>
<html>
<head><title>Registrar</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Cadastro</h1>
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/register" class="space-y-4">
            @csrf
            <input name="name" placeholder="Nome" value="{{ old('name') }}" required class="w-full p-2 border rounded">
            <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" required class="w-full p-2 border rounded">
            <input name="password" type="password" placeholder="Senha" required class="w-full p-2 border rounded">
            <input name="password_confirmation" type="password" placeholder="Confirmar Senha" required class="w-full p-2 border rounded">
            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">Registrar</button>
        </form>
        <div class="mt-4 text-center">
            <a href="/login" class="text-blue-600 hover:underline">Já tem conta? Entrar</a>
        </div>
    </div>
</body>
</html>
