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
</head>

<body>

    <!-- Menu -->
    <x-menu />

    @if(session('success'))
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta na tela
            icon: "success", // Tipo do ícone (sucesso)
            title: "{{ session('success') }}", // Mensagem que vem da sessão
            showConfirmButton: false, // Não mostra o botão de confirmação
            timer: 2000
        });
    </script>
    @endif

    @if(session('errors'))
    <script>
        Swal.fire({
            position: "center",
            icon: 'error', // Define o ícone como "error"
            title: 'Oops...', // Título da mensagem
            text: "{{ session('error') }}", // A mensagem de erro vinda da sessão
            showConfirmButton: false, // Não mostra o botão de confirmação
        });
    </script>
    @endif

    <div class="mt-32">
        @if(!empty($messages))
        <div class="text-center bg-gray-200 p-4 rounded shadow mb-4">
            @foreach($messages as $message)
            <h2 class="font-semibold  text-lg mb-4">{{ $message }}</h2>
            @endforeach
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Grid com 1 coluna em telas pequenas e 2 em telas médias -->
            <!-- Chamados com status 1 -->
            <div>
                @if($calledsStatus1->isNotEmpty())
                <h2 class="font-semibold text-lg mb-4 text-center bg-gray-200 p-4 rounded shadow mb-4">Chamados Pendentes</h2>
                @endif
                @foreach($calledsStatus1 as $called)
                <div class="bg-gray-200 p-4 rounded shadow mb-4">
                    <span class="font-semibold text-lg">Problema N°{{ $called->id }} {{ \Carbon\Carbon::parse($called->created_at)->format('d/m/Y ') }}</span>
                    <span class="block text-sm font-medium text-red-500">
                        Status: {{ $called->status }}
                    </span>
                    <span class="block text-sm font-medium">Problema: {{ $called->type_problem }}</span>
                    <span class="block text-sm font-medium">LUGAR: {{ $called->roof }}</span>
                    <span class="block text-sm font-medium">ANDAR: {{ $called->environment }}</span>
                    @if($called->obs != "")
                        <span class="block text-sm font-medium w-48 break-words">Observação: {{ $called->obs }}</span>
                    @endif
                    <span class="block text-sm font-medium">RM Solicitante: {{ $called->RM }} Rechamados {{ $called->recalled }}</span>
                    <form action="{{ route('called.updateStatus', $called->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <div class="flex">
                            <button type="submit" name="status" value="Em andamento" class="bg-orange-500 text-white p-2 rounded hover:bg-orange-600 mr-2">
                                Em andamento
                            </button>
                            <button type="submit" name="status" value="Concluído" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                                Concluir
                            </button>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>

            <!-- Chamados com status 2 -->
            <div>
                @if($calledsStatus2->isNotEmpty())
                <h2 class="font-semibold text-lg mb-4 text-center bg-gray-200 p-4 rounded shadow mb-4">Chamados Em Andamento</h2>
                @endif

                @foreach($calledsStatus2 as $called)
                <div class="bg-gray-200 p-4 rounded shadow mb-4">
                    <span class="font-semibold text-lg">Problema N°{{ $called->id }} {{ \Carbon\Carbon::parse($called->created_at)->format('d/m/Y ') }}</span>
                    <span class="block text-sm font-medium text-orange-500">
                        Status: {{ $called->status }}
                    </span>
                    <span class="block text-sm font-medium">Problema: {{ $called->type_problem }}</span>
                    <span class="block text-sm font-medium">LUGAR: {{ $called->roof }}</span>
                    <span class="block text-sm font-medium">ANDAR: {{ $called->environment }}</span>

                    @if($called->obs != "")
                        <span class="block text-sm font-medium w-48 break-words">Observação: {{ $called->obs }}</span>
                    @endif

                    <span class="block text-sm font-medium">RM Solicitante: {{ $called->RM }} Rechamados {{ $called->recalled }}</span>
                    <form action="{{ route('called.updateStatus', $called->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" name="status" value="Concluído" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                            Concluir
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col items-center">
            @if($reservations->isNotEmpty())
            <h2 class="font-semibold text-lg mb-4 text-center bg-gray-200 p-4 rounded shadow mb-4">Reservas Pendentes</h2>
            @endif

            @foreach($reservations as $reservation)
            <div class="bg-gray-200 p-4 rounded shadow mb-4 ">
                <span class="font-semibold text-lg">Quadra Poliesportiva N°{{ $reservation->id }}</span>
                <span class="block text-sm font-medium">Reserva para: {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y \à\s H:i') }}</span>
                <span class="block text-sm font-medium">RM Solicitante: {{ $reservation->RM }}</span>
                <div class="mt-4 flex space-x-4">
                    <span class="block text-sm font-medium">Integrantes: {{ $reservation->integrantes }}</span>
                </div>

                <!-- Botões para aceitar ou recusar -->
                <div class="mt-4 flex space-x-4">
                    <form action="{{ route('reservation.accept', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-6 py-3 w-auto bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-300">
                            Aceitar
                        </button>
                    </form>

                    <form action="{{ route('reservation.reject', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-6 py-3 w-auto bg-red-500 text-white rounded hover:bg-red-600 transition-colors duration-300">
                            Recusar
                        </button>
                    </form>
                </div>


            </div>
            @endforeach
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