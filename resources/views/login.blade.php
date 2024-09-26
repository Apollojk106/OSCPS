<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Centro Paula Souza</title>

    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>

    <!-- Página de Login -->
    <div id="login-page" class="login-container">
        <h1>Centro Paula Souza</h1>
        <form action="javascript:void(0)">
            <button type="button" class="login-btn" onclick="showPage('student-login')">Aluno</button>
            <button type="button" class="login-btn" onclick="showPage('teacher-login')">Professor</button>
        </form>
        <a href="javascript:void(0)" class="forgot-password" onclick="showPage('forgot-password')">Esqueci a senha</a>
    </div>

    <!-- Página de Login do Aluno -->
    <div id="student-login" class="login-container" style="display: none;">
        <h1>Login - Aluno</h1>
        <form action="/student">
            <label for="student-rm">RM:</label>
            <input type="text" id="student-rm" name="rm" required>
            <label for="student-password">Senha:</label>
            <input type="password" id="student-password" name="password" required>

            <button type="submit">Entrar</button>
        </form>

        <a href="javascript:void(0)" class="back-btn" onclick="showPage('login-page')">Voltar</a>
    </div>

    <!-- Página de Login do Professor -->
    <div id="teacher-login" class="login-container" style="display: none;">
        <h1>Login - Professor</h1>
        <form action="/teacher">
            <label for="teacher-rm">RM:</label>
            <input type="text" id="teacher-rm" name="rm" required>
            <label for="teacher-password">Senha:</label>
            <input type="password" id="teacher-password" name="password" required>

            <button type="submit">Entrar</button>
        </form>

        <a href="javascript:void(0)" class="back-btn" onclick="showPage('login-page')">Voltar</a>
    </div>

    <!-- Página de Esqueci a Senha -->
    <div id="forgot-password" class="login-container" style="display: none;">
        <h1>Redefinir Senha</h1>
        <form action="javascript:void(0)" onsubmit="sendResetCode()">
            <label for="rm">RM:</label>
            <input type="text" id="rm" name="rm" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Enviar Código</button>
        </form>
        <a href="javascript:void(0)" class="back-btn" onclick="showPage('login-page')">Voltar</a>
    </div>

    <!-- Página de Troca de Senha -->
    <div id="reset-password" class="login-container" style="display: none;">
        <h1>Trocar Senha</h1>
        <form action="javascript:void(0)" onsubmit="changePassword()">
            <label for="new-password">Nova Senha:</label>
            <input type="password" id="new-password" name="new-password" required>
            <label for="confirm-password">Confirme a Senha:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <div id="password-error" class="error-message" style="display: none;">As senhas não conferem</div>
            <button type="submit">Trocar Senha</button>
        </form>
        <a href="javascript:void(0)" class="back-btn" onclick="showPage('login-page')">Voltar</a>
    </div>

