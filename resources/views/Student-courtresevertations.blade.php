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
            background-color: #B30000;
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

    <div class="min-h-screen bg-gray-100 flex justify-center items-start w-30">
    <!-- Aumenta a largura do contêiner do formulário em 30% -->
    <div class="w-[130%] max-w-md bg-white p-6 rounded-lg shadow-lg grid gap-6 mt-40">

        <form action="{{ route('post.student.courtresevertations') }}" method="POST">
            @csrf
            <!-- Turma -->
            <div class="mb-4">
                <label for="class" class="block text-gray-700 font-semibold mb-2">Turma</label>
                <select id="class" name="class" required class="w-full p-3 border border-gray-300 rounded-md">
                    <option value="">Selecione uma turma</option>
                    <option value="turma1">Turma 1</option>
                    <option value="turma2">Turma 2</option>
                    <option value="turma3">Turma 3</option>
                </select>
            </div>

            <!-- Data -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-semibold mb-2">Data</label>
                <input type="date" id="date" name="date" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <!-- Horário -->
            <div class="mb-4">
                <label for="time" class="block text-gray-700 font-semibold mb-2">Horário</label>
                <input type="time" id="time" name="time" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <!-- Integrantes -->
            <div class="mb-4">
                <label for="integrantes" class="block text-gray-700 font-semibold mb-2">Integrantes</label>
                <textarea id="integrantes" name="integrantes" rows="4" placeholder="Insira os nomes dos integrantes..." required
                    class="w-full p-3 border border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <button type="button" onclick="window.location='/Student/dashboard'"
                    class="w-full rounded-md transition duration-300">
                    Retornar
                </button>
                <button type="submit"
                    class="w-full rounded-md transition duration-300">
                    Enviar
                </button>
            </div>

        </form>
    </div>
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