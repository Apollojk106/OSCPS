<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
        <h1 class="oscps" color="red">OSCps</h1>
        <form action="/dashboard" class="frame" method="POST">
            @csrf
            <div class="sign-up">
                <div class="title">
                    
                    <div class="text">Log-in</div>
                </div>
                <div class="subtitle">
                    <div class="text">Use seu RM ou email corporativo.</div>
                </div>
                <div class="text-field-outlined">
                    <input type="text" class="input-text" placeholder="Usuário" required>
                </div>
                <div class="text-field-outlined-error">
                    <input type="password" class="input-text" placeholder="Senha" required>
                </div>
                <div class="contained-button">
                    <button type="submit" class="label">Entre no Site</button>
                            <div class="administrativo-secretaria">Administrativo/Secretaria</div>

                </div>
            </div>
        </form>

 
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