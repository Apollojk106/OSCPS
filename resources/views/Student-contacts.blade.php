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
            width: 300px;
            margin: 10px;

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
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }
        button {
            width: 10%;
            padding: 10px;
            background-color: #842519;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            
        }
        button:hover {
            background-color: #701a0e;
        }
        </style>
</head>
<body >
   
    <!-- Header -->
    <x-header />
    
    <div class="card-contatos">
        <h3>Email</h3>
        <p>email@gmail.com</p>
        <br>
        <h3>Telefone</h3>
        <p>(11) 11111-1111</p>
        <br>
        <h3>Horário de funcionamento</h3>
        <p>Seg á Sex das 07h ás 22h50</p>
        <br>

    </div>
    
    <button onclick="document.location='/Student/dashboard'">Retornar</button>
    
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
        const cardContatos = document.querySelector('.card-contatos'); // Altera a referência para a div correta
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