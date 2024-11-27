<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <!-- Menu -->
    <x-menu />

    <div class=" mx-auto p-6 mt-20">
        <div class="bg-gray-100 p-4 rounded shadow flex justify-center items-center">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        </div>
        <br>
        <div class="grid grid-cols-2 gap-6">
            <div class="bg-gray-100 p-4 rounded shadow">
                <h2 class="font-semibold text-lg">Chamados</h2>
                <p class="text-xl">Pendentes: {{$pendetCalled}}</p>
                <p class="text-xl">Total: {{$totalCalled}}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded shadow">
                <h2 class="font-semibold text-lg">Reservas</h2>
                <p class="text-xl">Pendentes: {{$pendetReserve}}</p>
                <p class="text-xl">Total: {{$totalReservate}}</p>
            </div>

        </div>

        <br>

        <div class="bg-gray-100 p-4 rounded shadow mb-4">
            <h2 class="font-semibold text-lg">Chamados</h2>
            <canvas id="myChartChamados"></canvas>
        </div>

        <div class="bg-gray-100 p-4 rounded shadow">
            <h2 class="font-semibold text-lg">Reservas</h2>
            <canvas id="myChartReservas"></canvas>
        </div>

        <script>
            function createChart(chartId, type, data) {
                const ctx = document.getElementById(chartId).getContext('2d');
                const myChart = new Chart(ctx, {
                    type: type,
                    data: data,
                    options: {
                        indexAxis: 'y',
                    }
                });
            }

            // Dados do gráfico de Chamados
            const chamadosData = {
                labels: ['Pendente', 'Em Andamento', 'Concluído'],
                datasets: [{
                    label: 'Chamados',
                    data: ['{{$pendetCalled}}', '{{$AndamentoCalled}}', '{{$ConcluidoCalled}}'],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Dados do gráfico de Reservas
            const reservasData = {
                labels: ['Pendente', 'Aceito', 'Negado'],
                datasets: [{
                    label: 'Reservas',
                    data: ['{{$pendetReserve}}', '{{$AndamentoReserve}}', '{{$ConcluidoReserve}}'],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            };


            createChart('myChartChamados', 'bar', chamadosData);
            createChart('myChartReservas', 'bar', reservasData);


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



</html>