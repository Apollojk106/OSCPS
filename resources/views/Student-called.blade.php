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
    <title>Formulário de Manutenção</title>

</head>

<body class="bg-gray-100 p-0">
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

    <div class="cards-section">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6 space-y-6 mt-5"> <!-- Adiciona margem superior -->
            <h2 class="form-title font-bold text-gray-800 text-center">Formulário de Manutenção</h2>
            <form method="POST" action=" {{route('post.student.called')}}">

                @csrf
                
                <div class="space-y-4">
                    <div class="flex flex-col">
                        <label for="type_problem" class="font-semibold text-gray-800">Problema</label>
                        <select id="type_problem" name="type_problem" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                            <option value="">Selecione um problema</option>
                            <option value="1">Elétricos</option>
                            <option value="2">Hidráulicos</option>
                            <option value="3">Prediais</option>
                            <option value="4">Maquinário</option>
                            <option value="5">Contenção de acidentes</option>
                            <option value="6">Manutenção preditiva</option>
                            <option value="7">Manutenção corretiva</option>
                        </select>
                    </div>

                    <div class="flex flex-col mt-4"> <!-- Adiciona margem superior entre os selects -->
                        <label for="andar" class="font-semibold text-gray-800">Andar</label>
                        <select id="roof" name="roof" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                            <option value="">Selecione um andar</option>
                            @foreach($andares as $andar)
                            <option value="{{ $andar->roof }}">{{ $andar->roof }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col mt-4"> <!-- Adiciona margem superior entre os selects -->
                        <label for="local" class="font-semibold text-gray-800">Local</label>
                        <select id="environment" name="environment" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                            <option value="">Selecione um local</option>
                        </select>
                    </div>
                </div>

                <div class="flex space-x-4 mt-6"> <!-- Adiciona espaçamento entre os botões -->
                    <a href="{{route('student.dashboard')}}" class="bg-red-800 text-white w-32 h-10 rounded-md flex items-center justify-center cursor-pointer">
                        <div class="font-bold text-sm">Retornar</div>
                    </a>
                    <button type="submit" class="bg-red-800 text-white w-32 h-10 rounded-md flex items-center justify-center cursor-pointer">
                        <div class="font-bold text-sm">Enviar</div>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript for Toggle and Zoom -->
    <script>
        const toggle = document.querySelector('.toggle');
        const body = document.body;

        toggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            toggle.classList.toggle('fa-sun');
            toggle.classList.toggle('fa-moon');
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

        const andarSelect = document.getElementById('roof');
        const localSelect = document.getElementById('environment');

        const localOptions = <?php echo json_encode($locais); ?>;

        andarSelect.addEventListener('change', function() {
            const selectedAndar = andarSelect.value;

            // Limpar as opções do combo box de local
            localSelect.innerHTML = '<option value="">Selecione um local</option>';

            // Se houver locais para o andar selecionado
            if (localOptions[selectedAndar]) {
                localOptions[selectedAndar].forEach(function(local) {
                    const option = document.createElement('option');
                    option.value = local;
                    option.textContent = local;
                    localSelect.appendChild(option);
                });
            }
        });
    </script>
</body>

</html>