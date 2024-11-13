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

<body>
    <!-- Cabeçalho -->
    <x-header />

    <!-- Seção de Cartões -->
    <main class="cards-section px-4 py-6">
        <!-- Grid de Cards Responsivos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-6">
            <a href="/Student/called" class="card maintenance bg-gray-200 p-4 rounded-lg shadow-md hover:bg-gray-300">
                <i class="fas fa-tools text-3xl mb-2"></i>
                <p>Aviso de Manutenção</p>
            </a>

            <a href="/Student/courtresevertations" class="card sports bg-gray-200 p-4 rounded-lg shadow-md hover:bg-gray-300">
                <i class="fas fa-futbol text-3xl mb-2"></i>
                <p>Solicitação de Uso <br> Quadra Poliesportiva</p>
            </a>

            <a href="/Student/contacts" class="card contact bg-gray-200 p-4 rounded-lg shadow-md hover:bg-gray-300">
                <i class="fas fa-phone text-3xl mb-2"></i>
                <p>Contatos</p>
            </a>
        </div>
    </main>

    <!-- JavaScript para Toggle e Zoom -->
    <script>
        const toggle = document.querySelector('.toggle');
        const body = document.body;
        document.getElementById('botão-logout').addEventListener('clique', function() {
            document.getElementById('formulário-logout').submit();
        });
        toggle.addEventListener('clique', () => {
            body.classList.toggle('modo-escuro');
            toggle.classList.toggle('fa-sol');
            toggle.classList.toggle('fa-lua');
        });

        let zoomLevel = 1;
        const zoomInButton = document.getElementById('aumentar o zoom');
        const zoomOutButton = document.getElementById('diminuir o zoom');
        const mainContent = document.querySelector('.cards-section');

        zoomInButton.addEventListener('clique', () => {
            zoomLevel += 0.1;
            mainContent.style.transform = `scale(${zoomLevel})`;
        });

        zoomOutButton.addEventListener('clique', () => {
            zoomLevel = Math.max(0.5, zoomLevel - 0.1);
            mainContent.style.transform = `scale(${zoomLevel})`;
        });
    </script>
</body>
</html>
