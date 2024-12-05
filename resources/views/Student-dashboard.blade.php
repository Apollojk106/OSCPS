<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

    <!--<body class="bg-black text-white">  Cor de fundo preta e texto branco -->
    <!-- Cabeçalho -->
    <x-header class="bg-black" /> <!-- Garantir que o cabeçalho tenha fundo preto -->

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

    <!-- Seção de Cartões -->
    <main class="cards-section px-4 py-6">
        <!-- Grid de Cards Responsivos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <a href="/Student/called" class="card maintenance bg-gray-700 p-4 rounded-lg shadow-md">
                <i class="fas fa-tools text-3xl mb-2"></i>
                <p>Aviso de Manutenção</p>
            </a>

            <a href="/Student/courtresevertations" class="card sports bg-gray-700 p-4 rounded-lg shadow-md">
                <i class="fas fa-futbol text-3xl mb-2"></i>
                <p>Solicitação de Uso <br> Quadra Poliesportiva</p>
            </a>

            <a href="/Student/contacts" class="card contact bg-gray-700 p-4 rounded-lg shadow-md">
                <i class="fas fa-phone text-3xl mb-2"></i>
                <p>Contatos</p>
            </a>
        </div>
    </main>

    <!-- JavaScript para Toggle e Zoom -->
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
    </script>
</body>
</html>
