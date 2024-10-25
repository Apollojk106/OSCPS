<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Formulário de Manutenção</title>
    
</head>
<body class="bg-gray-100 p-0">
    <!-- Header -->
    <x-header />

    <div class="cards-section" >
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6 space-y-6 mt-5"> <!-- Adiciona margem superior -->
        <h2 class="form-title font-bold text-gray-800 text-center">Formulário de Manutenção</h2>
    <form method="POST" action="/called">   
        @csrf 
        <div class="space-y-4">
            <div class="flex flex-col">
                <label for="problema" class="font-semibold text-gray-800">Problema</label>
                <select id="problema" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                    <option value="">Selecione um problema</option>
                    <option value="manutencao">Manutenção</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="andar" class="font-semibold text-gray-800">Andar</label>
                <select id="andar" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                @foreach($dados as $dado)
                <option value="{{ $dado->roof }}">{{$dado->roof }}</option>
                @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label for="local" class="font-semibold text-gray-800">Local</label>
                <select id="local" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                    <option value="">Selecione um local</option>
                    <option value="sala1">Sala 1</option>
                    <option value="sala2">Sala 2</option>
                    <option value="sala3">Sala 3</option>
                </select>
            </div>
        </div>

        <div class="flex justify-between">
            <a href="{{route('Dashboard')}}" class="bg-red-800 text-white w-32 h-10 rounded-md flex items-center justify-center cursor-pointer">
                <div class="font-bold text-sm">Retornar</div>
            </a>
            <button type="submit" class="bg-red-800 text-white w-32 h-10 rounded-md flex items-center justify-center cursor-pointer">
                <div class="font-bold text-sm">Enviar</div>
            </button>
        </div>
    </form>
    </div>
    </div>

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