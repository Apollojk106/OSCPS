<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <x-header />

    <!-- Cards Section -->
    <main class="cards-section">
        <a href="/Student/called" class="card maintenance">
            <i class="fas fa-tools"></i>
            <p>Aviso de Manutenção</p>
        </a>
        <a href="/Student/courtresevertations" class="card sports">
            <i class="fas fa-futbol"></i>
            <p>Solicitação de Uso <br> Quadra Poliesportiva</p>
        </a>
        <a href="/Student/contacts" class="card contact">
            <i class="fas fa-phone"></i>
            <p>Contatos</p>
        </a>
    </main>

    <!-- JavaScript for Toggle and Zoom -->
    <script>
        const toggle = document.querySelector('.toggle');
        const body = document.body;

        document.getElementById('logout-button').addEventListener('click', function() {
            document.getElementById('logout-form').submit();
        });

        toggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            toggle.classList.toggle('fa-sun');
            toggle.classList.toggle('fa-moon');
        });

        let zoomLevel = 1;
        const zoomInButton = document.getElementById('zoom-in');
        const zoomOutButton = document.getElementById('zoom-out');
        const mainContent = document.querySelector('.cards-section');

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