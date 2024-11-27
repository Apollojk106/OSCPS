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
            <h2 class="text-center text-2xl font-semibold mb-4">Você tem certeza que deseja deletar esta classe?</h2>
            <form action="/Adm/config/delete-class" method="POST">
                <input type="hidden" name="class" value="{{ $class }}">
                @csrf
                <div>
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">
                        Excluir
                    </button>
                    <button type="button" class="ml-4 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" onclick="window.location.href = `/Adm/config`;">
                        Cancelar
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