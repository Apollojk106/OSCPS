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

    <div class=" mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <div class="grid grid-cols-2 gap-6">
            <div class="bg-gray-100 p-4 rounded shadow">
                <h2 class="font-semibold text-lg">Notificações Pendentes</h2>
                <p class="text-xl">{{$total}}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded shadow">
                <h2 class="font-semibold text-lg">Histórico Total</h2>
                <p class="text-xl">Veja seu histórico</p>
                
            </div>
            <div class="bg-gray-100 p-4 rounded shadow">
                <h2 class="font-semibold text-lg">Informações</h2>
                <p class="text-xl">Verifique suas configurações</p>
                
            </div>
            <div class="bg-gray-100 p-4 rounded shadow">
                <h2 class="font-semibold text-lg">Dashboard</h2>
                <p class="text-xl">Visualize seu desempenho</p>
               
            </div>
        </div>
    </div>

</body>

</html>