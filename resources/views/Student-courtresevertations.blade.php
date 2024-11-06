<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 50px;

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

        button {
            width: 48%;
            padding: 10px;
            background-color: #842519;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;

        }

        button:hover {
            background-color: #701a0e;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <x-header />

    <h1>Solicitação de quadra poliesportiva</h1>

    <div class="form-container">
        <form action="{{route('post.student.courtresevertations')}}" method="POST">
            @csrf
            {{-- Sucesso --}}
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            {{-- Erro --}}
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div>
                <label for="turma">Turma</label>
                <select id="class" name="class" required>
                    <option value="">Selecione uma turma</option>
                    <option value="turma1">Turma 1</option>
                    <option value="turma2">Turma 2</option>
                    <option value="turma3">Turma 3</option>
                </select>
            </div>
            <div>
                <label for="data">Data</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div>
                <label for="time">Horário</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div>
                <label for="integrantes">Integrantes</label>
                <textarea id="integrantes" name="integrantes" rows="4" placeholder="Insira os nomes dos integrantes..." required></textarea>
            </div>
            <div class="flex justify-between">
                <button onclick=" document.location='/Student/dashboard'">Retornar</button>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

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