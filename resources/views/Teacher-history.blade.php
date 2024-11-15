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

    <div class="p-4">

        <form method="GET" action="{{ route('teacher.history.filter') }}" class="mb-4">
            <label for="status" class="block text-sm font-medium">Filtrar por Status</label>
            <select name="status" id="status" class="mt-1 p-2 border rounded">
                <option value="Todos">Todos</option>
                <option value="1" {{ request('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="2" {{ request('status') == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                <option value="3" {{ request('status') == 'Concluido' ? 'selected' : '' }}>Concluído</option>
            </select>
            <button type="submit" class="bg-[#701a0e] ml-2 p-2 text-white rounded">Filtrar</button>
        </form>

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

        @foreach($reservations as $reservation)
        <div class="bg-gray-200 p-4 rounded shadow mb-4">
            <span class="font-semibold text-lg">Quadra Poliesportiva N°{{ $reservation->id }}</span>
            <span class="block text-sm font-medium">Reserva para: {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y \à\s H:i') }}</span>
            <span class="block text-sm font-medium">RM Solicitante: {{ $reservation->RM }}</span>

            @if($reservation->status == 1)
                <span class="block text-sm font-medium text-yellow-500">Status: Pendente</span>
            @elseif($reservation->status == 2)
                <span class="block text-sm font-medium text-green-500">Status:Aceito</span> 
            @else
                <span class="block text-sm font-medium text-red-500">Status: Recusado</span>                
            @endif
          
            <div class="mt-4 flex space-x-4">
                <span class="block text-sm font-medium">integrantes: {{ $reservation->integrantes }}</span>
            </div>
        </div>
        @endforeach

    </div>

</body>

</html>
