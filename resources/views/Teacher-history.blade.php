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

<body>
    <!-- Menu -->
    <x-menu />

    <div class="p-4">

        <div class="bg-gray-200 p-4 rounded shadow mb-4">
            <span class="font-semibold text-lg">Problema N°34 22/06/2024 às 20:30</span>
            <span class="block text-sm font-medium">Status: Resolvido dia 15/07/2024 às 20:31</span>
            <span class="block text-sm font-medium">Problema: Elétrico</span>
            <span class="block text-sm font-medium">LUGAR/ANDAR: LAB-2/2A</span>
            <span class="block text-sm font-medium">RM Solicitante: 20232912344 </span>
        </div>

        @foreach($calleds as $called)
        <div class="bg-gray-200 p-4 rounded shadow mb-4">
            <span class="font-semibold text-lg">Problema N°{{ $called->id }} {{ \Carbon\Carbon::parse($called->created_at)->format('d/m/Y ') }}</span>
            <span class="block text-sm font-medium">Status: {{ $called->status }}</span>
            <span class="block text-sm font-medium">Problema: {{ $called->type_problem }}</span>
            <span class="block text-sm font-medium">LUGAR/ANDAR: {{ $called->roof }}/{{ $called->environment }}</span>
            <span class="block text-sm font-medium">RM Solicitante: {{ $called->RM }}</span>
        </div>
        @endforeach

        @foreach($reservations as $reservation)
        <div class="bg-gray-200 p-4 rounded shadow mb-4">
            <span class="font-semibold text-lg">Quadra Poliesportiva N°{{ $reservation->id }}</span>
            <span class="block text-sm font-medium">Reserva para: {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y \à\s H:i') }}</span>
            <span class="block text-sm font-medium">RM Solicitante: {{ $reservation->name_user }}</span>
            <div class="mt-4 flex space-x-4">
            <span class="block text-sm font-medium">integrantes: {{ $reservation->integrantes }}</span>
            </div>
        </div>
        @endforeach

    </div>

</body>

</html>