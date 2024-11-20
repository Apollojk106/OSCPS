<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Troca de Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="background-color: #842519; color: white;">
    <div class="title text-center mb-6">
        <h1 class="oscps" style="color:white;">OSCPS</h1>
    </div>
    <div class="text-center bg-gray-200 p-4 rounded shadow mb-4 ">
        <div class="title">
            <div class="text">Olá,</div>
            <div class="text">Esperamos que esteja bem.
                <br> Estamos entrando em contato para informá-lo,
                <br> sobre uma atualização importante em seu processo.</div>
            <br>
            @if($reservation)
            <div class="text">A reserva de ID #{{ $reservation->id }} foi {{ $action }}.</div>
            <br>
            <div class="text">Status atual: {{ $reservation->status }}</div>
            @elseif($called)
            <div class="text">O chamado #{{ $called->id }} teve seu status atualizado para {{ $status }}.</div>
            @endif
            <br>
            <div class="text">Gostaríamos de agradecer pela sua colaboração e confiança. 
                <br>Sua participação é fundamental para o sucesso do nosso sistema.</div>
            <br>
            <div class="text">Atenciosamente, OSPCS</div>
            <div class="text">Equipe do Sistema</div>
        </div>
    </div>
</body>

</html>