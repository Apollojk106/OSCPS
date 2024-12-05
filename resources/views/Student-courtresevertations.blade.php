<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            margin-top: 50px;

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

        button {
            width: 48%;
            padding: 10px;
            background-color: #cc1c22;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;

        }

        button:hover {
            background-color: #842519;
        }

        .swal-btn {
            padding: 14px 40px !important;
            /* Ajusta o tamanho do botão */
            font-size: 18px !important;
            /* Ajusta o tamanho da fonte */
            border-radius: 8px !important;
            /* Bordas arredondadas */
            width: 100% !important;
            /* Faz o botão ocupar 100% da largura do pop-up */
            box-sizing: border-box !important;
            /* Garantir que o padding seja incluído na largura */
        }

        /* Ajusta a largura do pop-up para que o conteúdo e o botão se ajustem */
        .swal2-popup {
            min-width: 300px !important;
            /* Definindo uma largura mínima */
            width: auto !important;
            /* Ajuste a largura automaticamente */
        }

        /* Ajusta a largura do conteúdo para que o botão acompanhe */
        .swal2-html-container {
            max-width: 100% !important;
            /* Ajusta a largura máxima do conteúdo */
        }
    </style>

</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <!-- Header -->
    <x-header />

    @if(session('success'))
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta na tela
            icon: "success", // Tipo do ícone (sucesso)
            title: "{{ session('success') }}", // Mensagem que vem da sessão
            showConfirmButton: false, // Não mostra o botão de confirmação
            timer: 1500 // O alerta desaparece após 1.5 segundos
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta
            icon: 'error', // Ícone de erro
            title: 'Oops...', // Título do alerta
            html: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>', // Lista de erros
            showConfirmButton: true, // Mostra o botão de confirmação
            confirmButtonText: 'OK', // Texto do botão
            customClass: {
                confirmButton: 'swal-btn' // Classe customizada para o botão
            }
        });
    </script>
    @endif

    <div class="max-h-sm max-w-lg bg-gray-100 flex justify-center items-start w-30">
        <!-- Aumenta a largura do contêiner do formulário em 30% -->
        <div class="w-[130%] max-w-md bg-white p-6 rounded-lg shadow-lg grid gap-6 relative top-16 sm:top-30">

            <form action="{{ route('post.student.courtresevertations') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <!-- Turma -->
                    <div class="mb-4">
                        <label for="class" class="block text-gray-700 font-semibold mb-2">Turma</label>
                        <select id="class" name="class" required class="w-full p-3 border border-gray-300 rounded-md">
                            <option value="">Selecione uma turma</option>
                            @foreach($classes as $class)
                            <option value="{{$class->class}}">{{$class->class}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data -->
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-semibold mb-2">Data</label>
                        <input type="date" id="date" name="date" required class="w-full p-3 border border-gray-300 rounded-md">
                    </div>

                    <!-- Integrantes -->
                    <div class="mb-4">
                        <label for="integrantes" class="block text-gray-700 font-semibold mb-2">Integrantes</label>
                        <textarea id="integrantes" name="integrantes" rows="4" placeholder="Insira os nomes dos integrantes..." required
                            class="w-full p-3 border border-gray-300 rounded-md"></textarea>
                    </div>

                    <!-- Horário -->
                    <div class="mb-4">
                        <label for="time" class="block text-gray-700 font-semibold mb-2">Horário</label>
                        <input type="time" id="time" name="time" required class="w-full p-3 border border-gray-300 rounded-md">
                    </div>



                    <!-- Buttons -->

                    <button type="submit"
                        class="w-full rounded-md transition duration-300">
                        Enviar
                    </button>

                    <button type="button" onclick="window.location='/Student/dashboard'"
                        class="w-full rounded-md transition duration-300">
                        Retornar
                    </button>


                </div>

            </form>
        </div>
    </div>




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