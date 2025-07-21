<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <form method="POST" action="/login">
        @csrf
        <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
        <input name="password" type="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
