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
<!-- Página do Dashboard do Professor -->
    <div id="teacher-dashboard" class="dashboard">
        <div class="header">
            <span>Nome do Professor</span>
            <button onclick="toggleTheme()">Tema Escuro</button>
            <form action="/login">
            <button class="logout-btn" type="submit">Sair</button>
            </form>
        </div>
        <div class="hotbar">
            <a href="javascript:void(0)" onclick="showPage('recent-forms')">Formulários Recentes</a>
            <a href="javascript:void(0)" onclick="showPage('viewed-forms')">Formulários Vistos</a>
            <a href="javascript:void(0)" onclick="showPage('history')">Histórico</a>
            <a href="javascript:void(0)" onclick="showPage('sports-forms')">Formulários da Quadra</a>
        </div>
        <div class="dashboard-content">
            <!-- O conteúdo será gerado dinamicamente com base na seleção na hotbar -->
        </div>
    </div>

    <!-- Página de Formulários Recentes -->
    <div id="recent-forms" class="dashboard-content" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('teacher-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Formulários Recentes</h1>
        <!-- Adicione aqui os formulários recentes -->
    </div>

    <!-- Página de Formulários Vistos -->
    <div id="viewed-forms" class="dashboard-content" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('teacher-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Formulários Vistos</h1>
        <!-- Adicione aqui os formulários vistos -->
    </div>

    <!-- Página de Histórico -->
    <div id="history" class="dashboard-content" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('teacher-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Histórico de Formulários</h1>
        <!-- Adicione aqui o histórico de formulários -->
    </div>

    <!-- Página dos Formulários da Quadra -->
    <div id="sports-forms" class="dashboard-content" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('teacher-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Formulários da Quadra</h1>
        <!-- Adicione aqui os formulários da quadra -->
    </div>

    <script src="script.js"></script>
</body>

