<!DOCTYPE html>
<html>
<head><title>Registrar</title></head>
<body>
    <form method="POST" action="/register">
        @csrf
        <input name="name" placeholder="Nome" value="{{ old('name') }}" required>
        <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
        <input name="password" type="password" placeholder="Senha" required>
        <input name="password_confirmation" type="password" placeholder="Confirmar Senha" required>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
