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
</head>

<body>

    <!-- Menu -->
    <x-menu />

    @if(session('success'))
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta na tela
            icon: "success", // Tipo do ícone (sucesso)
            title: "{{ session('success') }}", // Mensagem que vem da sessão
            showConfirmButton: false, // Não mostra o botão de confirmação
            timer: 2000 
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

    @foreach($calleds as $called)
    
    <div class="bg-gray-200 p-4 rounded shadow mb-4">
        <span class="font-semibold text-lg">Problema N°{{ $called->id }} {{ \Carbon\Carbon::parse($called->created_at)->format('d/m/Y ') }}</span>

        <!-- Exibindo Status com cores dinâmicas -->
        <span class="block text-sm font-medium 
            @if($called->status == 'Pendente') text-red-500
            @elseif($called->status == 'Em Andamento') text-orange-500  
            @else text-gray-500 @endif">
            Status: {{ $called->status }}
        </span>

        <span class="block text-sm font-medium">Problema: {{ $called->type_problem }}</span>
        <span class="block text-sm font-medium">LUGAR: {{ $called->roof }}</span>
        <span class="block text-sm font-medium">ANDAR:{{ $called->environment }}</span>
        <span class="block text-sm font-medium">RM Solicitante: {{ $called->RM }} Rechamados {{ $called->recalled }}</span>

        <!-- Botões para mudar o status -->
        <form action="{{ route('called.updateStatus', $called->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PATCH')
            <!-- Se o status for 'Pendente', exibe dois botões -->
            @if($called->status == 'Pendente')
            <div class="flex">
                <button type="submit" name="status" value="Em andamento" class="bg-orange-500 text-white p-2 rounded hover:bg-orange-600 mr-2">
                    Em andamento
                </button>
                <button type="submit" name="status" value="Concluído" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                    Concluir
                </button>
            </div>
            @else
            <button type="submit" name="status" value="Concluído" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                Concluir
            </button>
            @endif
        </form>
    </div>
    
    @endforeach


    @foreach($reservations as $reservation)
    <div class="bg-gray-200 p-4 rounded shadow mb-4 ">
        <span class="font-semibold text-lg">Quadra Poliesportiva N°{{ $reservation->id }}</span>
        <span class="block text-sm font-medium">Reserva para: {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y \à\s H:i') }}</span>
        <span class="block text-sm font-medium">RM Solicitante: {{ $reservation->RM }}</span>
        <div class="mt-4 flex space-x-4">
            <span class="block text-sm font-medium">Integrantes: {{ $reservation->integrantes }}</span>
        </div>

        <!-- Botões para aceitar ou recusar -->
        <div class="mt-4 flex space-x-4">
            <form action="{{ route('reservation.accept', $reservation->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-6 py-3 w-auto bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-300">
                    Aceitar
                </button>
            </form>

            <form action="{{ route('reservation.reject', $reservation->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-6 py-3 w-auto bg-red-500 text-white rounded hover:bg-red-600 transition-colors duration-300">
                    Recusar
                </button>
            </form>
        </div>

        
    </div>
    @endforeach


</body>

</html>
