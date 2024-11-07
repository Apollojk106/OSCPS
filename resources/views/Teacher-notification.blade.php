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


    @foreach($calleds as $called)
    <div class="bg-gray-200 p-4 rounded shadow mb-4">
        <span class="font-semibold text-lg">Problema N°{{ $called->id }} {{ \Carbon\Carbon::parse($called->created_at)->format('d/m/Y \à\s H:i') }}</span>
        <span class="block text-sm font-medium">Status: Pendente</span>
        <span class="block text-sm font-medium">Problema: {{ $called->type_problem_name }}</span>
        <span class="block text-sm font-medium">LUGAR/ANDAR: {{ $called->roof }}/{{ $called->environment }}</span>
        <span class="block text-sm font-medium">RM Solicitante: {{ $called->email }}</span>
    </div>
    @endforeach

    <div class="bg-gray p-4 rounded shadow mb-4">
        <span class="font-semibold">Notificação Pendente</span>
        <p>Elétrica 13/07/2024 às 20:40</p>
    </div>

    <div class="bg-gray-200 p-4 rounded shadow mb-4 mx-auto">
        <span class="font-semibold">Notificação Pendente</span>
        <p>Elétrica 13/07/2024 às 20:40</p>
    </div>

</body>

</html>