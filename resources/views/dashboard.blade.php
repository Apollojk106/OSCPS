<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <span class="oscps">OSCps</span>
        <div class="header-icons">
            <i class="fas fa-search-plus" id="zoom-in" title="Zoom In"></i>
            <i class="fas fa-search-minus" id="zoom-out" title="Zoom Out"></i>
            <i class="fas fa-sun toggle" title="Toggle Theme"></i>
            
            <i class="fas fa-sign-out-alt logout-icon" title="Logout"></i>
        </div>
    </header>

    <!-- Cards Section -->
    <main class="cards-section">
        <a href="/called" class="card maintenance">
            <i class="fas fa-tools"></i>
            <p>Aviso de Manutenção</p>
        </a>
        <a href="/courtresevertations" class="card sports">
            <i class="fas fa-futbol"></i>
            <p>Solicitação de Uso <br> Quadra Poliesportiva</p>
        </a>
        <a href="/contacts" class="card contact">
            <i class="fas fa-phone"></i>
            <p>Contatos</p>
        </a>
    </main>

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