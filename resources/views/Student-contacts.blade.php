<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Formulário de Manutenção</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card-contatos {
            background-color: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin: 10px;

            display: flex;
            flex-direction: column;

            justify-content: center;

            align-items: center;

            text-align: center;

        }

        h2 {
            text-align: center;
            border-radius: 4px;
            margin-bottom: 20px;
            background-color: #842519;
            color: #ffff;

        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #4a5568;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }

    </style>
</head>

<body>

    <!-- Header -->
    <x-header />
    
    <div class="card-contatos">
        <h3 class="form-title font-bold text-gray-800 text-center">Contatos</h3><br>

        <h3>Horário de funcionamento</h3>
        <p>Seg á Sex das 07h ás 22h50</p><br>

        @foreach($secretaries as $secretary)
        <h3>Nome: {{$secretary->name}}</h3>
        <h3>Email: {{$secretary->email}}</h3>
        <h3>Horario presente: {{ $secretary->entry_time }} ás {{ $secretary->exit_time }}</h3>
        <br>
        @endforeach
    </div>

    <button class="text-white w-32 h-10 rounded-md flex items-center justify-center cursor-pointer" onclick="document.location='/Student/dashboard'">Retornar</button>

    <script>
        const toggle = document.querySelector('.toggle');
        const body = document.body;

        // Função para aplicar o modo escuro com base na preferência armazenada
        function applyDarkMode() {
            const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
            if (darkModeEnabled) {
                body.classList.add('dark-mode');
                toggle.classList.add('fa-sun');
                toggle.classList.remove('fa-moon');
            } else {
                body.classList.remove('dark-mode');
                toggle.classList.remove('fa-sun');
                toggle.classList.add('fa-moon');
            }
        }

        // Chama a função ao carregar a página
        applyDarkMode();

        toggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            toggle.classList.toggle('fa-sun');
            toggle.classList.toggle('fa-moon');

            // Armazena a preferência no localStorage
            const darkModeEnabled = body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', darkModeEnabled);
        });

        let zoomLevel = 1;
        const zoomInButton = document.getElementById('zoom-in');
        const zoomOutButton = document.getElementById('zoom-out');
        const mainContent = document.querySelector('.max-w-lg');

        zoomInButton.addEventListener('click', () => {
            zoomLevel += 0.1;
            mainContent.style.transform = `scale(${zoomLevel})`;
        });

        zoomOutButton.addEventListener('click', () => {
            zoomLevel = Math.max(0.5, zoomLevel - 0.1);
            mainContent.style.transform = `scale(${zoomLevel})`;
        });

        function checkSelection() {
            const typeProblem = document.getElementById('type_problem').value;
            const roof = document.getElementById('roof').value;

            // Verifica se ambos os campos estão selecionados
            if (typeProblem && roof) {
                // Redireciona para a rota GET com os parâmetros
                window.location.href = `/Student/called/${roof}/${typeProblem}`;
            }
        }
    </script>
</body>

</html>