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


    </style>
</head>

<body>
    <!-- Menu -->
    <x-menu />
    <a class="p-4 mt-6"></a>

    <div class="p-4 mt-16">


        <form method="GET" action="{{ route('teacher.history.filter') }}" class="mb-4 flex items-center space-x-2">
            <select name="status" id="status" class="mt-1 p-2 border rounded">
                <option value="Todos">Todos</option>
                <option value="1" {{ request('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="2" {{ request('status') == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                <option value="3" {{ request('status') == 'Concluido' ? 'selected' : '' }}>Concluído</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Reserva Aceita</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Reserva Recusada</option>
            </select>
            <button type="submit" class="bg-[#cc1c22] p-2 text-white rounded">Filtrar</button>
        </form>

        <div class="flex justify-center itens ">


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">


                @if($calleds->isNotEmpty())
                <div>
                    <h2 class="font-semibold text-lg mb-4 text-center">Chamados</h2>
                    @endif
                    @foreach($calleds as $called)
                    <div class="bg-gray-200 p-4 rounded shadow mb-4">
                        <span class="font-semibold text-lg">Problema N°{{ $called->id }} {{ \Carbon\Carbon::parse($called->created_at)->format('d/m/Y ') }}</span>

                        <span class="block text-sm font-medium 
                        @if($called->status == 'Pendente') text-red-500
                        @elseif($called->status == 'Em Andamento') text-orange-500  
                        @else text-green-600 @endif">
                            Status: {{ $called->status }}
                        </span>

                        <span class="block text-sm font-medium">Problema: {{ $called->type_problem }}</span>
                        <span class="block text-sm font-medium">LUGAR: {{ $called->roof }}</span>
                        <span class="block text-sm font-medium">ANDAR:{{ $called->environment }}</span>
                        <span class="block text-sm font-medium">RM Solicitante: {{ $called->RM }} Rechamados {{ $called->recalled }}</span>
                    </div>

                    @endforeach
                    @if($calleds->isNotEmpty())
                </div>
                @endif


                @if($reservations->isNotEmpty())
                <div>
                    <h2 class="font-semibold text-lg mb-4 text-center">Reservas</h2>
                    @endif
                    @foreach($reservations as $reservation)
                    <div class="bg-gray-200 p-4 rounded shadow mb-4">
                        <span class="font-semibold text-lg">Quadra Poliesportiva N°{{ $reservation->id }}</span>
                        <span class="block text-sm font-medium">Reserva para: {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y \à\s H:i') }}</span>
                        <span class="block text-sm font-medium">RM Solicitante: {{ $reservation->RM }}</span>

                        @if($reservation->status == 1)
                        <span class="block text-sm font-medium text-yellow-500">Status: Pendente</span>
                        @elseif($reservation->status == "accepted")
                        <span class="block text-sm font-medium text-green-500">Status:Aceito</span>
                        @else
                        <span class="block text-sm font-medium text-red-500">Status: Recusado</span>
                        @endif

                        <div class="mt-4 flex space-x-4">
                            <span class="block text-sm font-medium">integrantes: {{ $reservation->integrantes }}</span>
                        </div>
                    </div>
                    @endforeach
                    @if($reservations->isNotEmpty())
                </div>

                @endif

            </div>
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