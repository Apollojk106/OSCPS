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

<body class="bg-gray-100">

    <x-header />

    <!-- Modal de Edição -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-md w-1/2">
            <br><br>
            <h2 class="text-2xl font-semibold mb-4">Editar Dados</h2>
            <form id="editForm" action="{{  route('secretary.update', $Secretary->id)  }}" method="POST">
                @csrf
                <div>
                    <label class="block mb-2">Nome:</label>
                    <input type="text" name="name" id="name" class="w-full mb-4 p-2 border rounded-md" value="{{$Secretary->name}}" required>
                    <label class="block mb-2">E-mail:</label>
                    <input type="email" name="email" class="w-full mb-4 p-2 border rounded-md" value="{{$Secretary->email}}" required>
                    <label class="block mb-2">Hora de Entrada:</label>
                    <input type="time" name="entry_time" class="w-full mb-4 p-2 border rounded-md" value="{{$Secretary->entry_time}}" required>
                    <label class="block mb-2">Hora de Saída:</label>
                    <input type="time" name="exit_time" class="w-full mb-4 p-2 border rounded-md" value="{{$Secretary->exit_time}}" required>
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Salvar</button>
                    <button type="button" class="ml-2 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" onclick="window.location.href='/Adm/config'">Cancelar</button>
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