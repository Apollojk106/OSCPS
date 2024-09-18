<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Centro Paula Souza</title>

    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ asset('js/app.js') }}"></script>
</head> 
       <!-- Página do Aluno -->
       <div id="student-dashboard" class="dashboard">
        <div class="header">
            <span>Nome do Aluno</span>
            <button onclick="toggleTheme()">Tema Escuro</button>
            <form action="/login">
            <button class="logout-btn" type="submit">Sair</button>
            </form>
        </div>
        <div class="dashboard-content">
            <div class="card" onclick="showPage('emergency-form')">
                <img src="https://via.placeholder.com/50?text=🔔" alt="Emergência">
                <span>Emergência</span>
            </div>
            <div class="card" onclick="showPage('sports-form')">
                <img src="https://via.placeholder.com/50?text=🏀" alt="Quadra">
                <span>Quadra</span>
            </div>
            <div class="card" onclick="showPage('secretary-info')">
                <img src="https://via.placeholder.com/50?text=📞" alt="Secretaria">
                <span>Secretaria</span>
            </div>
        </div>
    </div>

    <!-- Página do Formulário de Emergência -->
    <div id="emergency-form" class="form-container" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('student-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Formulário de Emergência</h1>
        <form id="emergency-form">
            <label for="location">Localização:</label>

            <select id="location" name="location">
                <option value="quadra">Quadra</option>
                <option value="banheiro">Banheiro</option>
                <option value="sala">Sala</option>
                <option value="corredor">Corredor</option>
            </select>
            <label for="floor">Andar:</label>
            <select id="floor" name="floor">

                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>

                <option value="corredor">Corredor</option>
                <option value="banheiro_f">Banheiro Feminino</option>
                <option value="banheiro_m">Banheiro Masculino</option>
            </select>

            <label for="issue">Tipo de Problema:</label>
            <select id="issue" name="issue">

                <option value="hidraulico">Hidráulico</option>
                <option value="infra">Infraestrutura</option>
                <option value="higiene">Higiene</option>
                <option value="informatica">Informátic
a</option>

                <option value="energia">Energia</option>
            </select>
            <button type="submit">Enviar</button>
        </form>

        <div id="emergency-notification" class="notification">Formulário enviado com sucesso!</div>
    </div>

    <!-- Página do Formulário da Quadra -->
    <div id="sports-form" class="form-container" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('student-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Formulário de Reserva de Quadra</h1>
        <form id="sports-form">
            <label for="court">Quadra:</label>
            <select id="court" name="court">
                <option value="1a">1a</option>
                <option value="1b">1b</option>
                <option value="2a">2a</option>
                <option value="2b">2b</option>
                <option value="3a">3a</option>
                <option value="3b">3b</option>

            </select>
            <label for="date">Data:</label>
            <input type="date" id="date" name="date">
            <label for="participants">Participant
es:</label>
            <input type="text" id="participants" name="participants">

            <button type="submit">Enviar</button>
        </form>

        <div id="sports-notification" class="notification">Formulário enviado com sucesso!</div>
    </div>

    <!-- Página das Informações da Secretaria -->
    <div id="secretary-info" class="form-container" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('student-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Informações da Secretaria</h1>
        <p><strong>Data e Horário de Funcionamento:</strong> Segunda a Sexta, das 8h às 17h</p>
        <p><strong>Telefone:</strong> (11) 1234-5678</p>
    </div>
