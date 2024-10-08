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
            <label for="andar">Andar:</label>

            <select id="andar" name="Andar:">
            @foreach($dados as $dado)
                <option value="{{ $dado->roof }}">{{$dado->roof }}</option>
            @endforeach
            </select>
            <label for="local">Localizção:</label>
            <select id="local" name="local">

                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>

                <option value="corredor">Corredor</option>
                <option value="banheiro_f">Banheiro Feminino</option>
                <option value="banheiro_m">Banheiro Masculino</option>
            </select>

            <label for="issue">Tipo de Problema:</label>
            <select id="issue" name="issue">

                <option value="Elétricos ">Elétricos </option>
                <option value="Hidráulicos ">Hidráulicos </option>
                <option value="Prediais">Prediais</option>
                <option value="Maquinário ( computadores)">Maquinário</option>
                <option value="Contenção de acidentes ( piso molhado ) ">Contenção de acidentes</option>
                <option value="infra">Manutenção preditiva </option>
                <option value="higiene">Manutenção corretiva</option>            
            </select>
            <button type="submit">Enviar</button>
        </form>
        <table class="table">
        <thead>
                <tr>
                <th scope="col">roof</th>
                </tr>
        </thead>
        @foreach($dados as $dado)
        <tbody>  
            <tr>
            <td>{{$dado->roof}}</td>
            </tr>        
        </tbody>
        @endforeach
        </table>

        <div id="emergency-notification" class="notification">Formulário enviado com sucesso!</div>
    </div>
    

    <!-- Página do Formulário da Quadra -->
    <div id="sports-form" class="form-container" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('student-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Formulário de Reserva de Quadra</h1>
        <p>{{ $userName ?? 'Nenhum nome salvo.' }}</p>
        <form id="sports-form" action="/student/court">       
            <label for="date">Data:</label>
            <input type="date" id="date" name="date">
            <label for="hora">Selecione uma hora:</label>
            <input type="time" id="hora" name="hora" required>
            <label for="participants">Participantes:</label>
            <textarea id="participants" name="participants"></textarea>

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
