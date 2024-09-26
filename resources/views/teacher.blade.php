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
            <a href="javascript:void(0)" onclick="showPage('dashboard')">dashboard</a>
            <a href="javascript:void(0)" onclick="showPage('viewed-forms')">Formulários Pendentes</a>
            <a href="javascript:void(0)" onclick="showPage('history')">Histórico</a>            
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
        <h1>Formulários Pendentes</h1>

        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">data de inicio</th>
                <th scope="col">data de termino</th>
                <th scope="col">status</th>
                <th scope="col">prioridade</th>
                <th scope="col">problema</th>
                <th scope="col">nome do solicitante</th>
                </tr>
            </thead>
            <tbody>
            @foreach($calleds as $called)
                @if($called->status == 1)
                <tr>
                <td>{{  $called->id }}</td>
                <td>{{ $called->date_open}}</td>
                <td>{{ $called->date_end}}</td>
                <td>{{ $called->status}}</td>
                <td>{{ $called->priority}}</td>
                <td>{{ $called->type_problem}}</td>
                <td>{{ $called->name}}</td>
                </tr> 
                @endif               
                @endforeach
            </tbody>
        </table>


    </div>

    <!-- Página de Histórico -->
    <div id="history" class="dashboard-content" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('teacher-dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Histórico de Formulários</h1>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">data de inicio</th>
                <th scope="col">data de termino</th>
                <th scope="col">status</th>
                <th scope="col">prioridade</th>
                <th scope="col">problema</th>
                <th scope="col">nome do solicitante</th>
                </tr>
            </thead>
            <tbody>
            @foreach($calleds as $called)
                <tr>
                <td>{{  $called->id }}</td>
                <td>{{ $called->date_open}}</td>
                <td>{{ $called->date_end}}</td>
                <td>{{ $called->status}}</td>
                <td>{{ $called->priority}}</td>
                <td>{{ $called->type_problem}}</td>
                <td>{{ $called->name}}</td>
                </tr>              
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Página dos Formulários da Quadra -->
    <div id="dashboard" class="dashboard-content" style="display: none;">
        <div class="header">
            <a href="javascript:void(0)" onclick="showPage('dashboard')" class="back-btn">Voltar</a>
        </div>
        <h1>Formulários da Quadra</h1>

        <h1>Notificações Pendentes {{$count}}<h1>
        <h1>Notificações Total {{count($calleds)}}<h1>
        
    </div>

    <script src="script.js"></script>
</body>

