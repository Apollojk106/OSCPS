<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Troca de Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="background-color: #FF161F; color: white;">
    <div class="title text-center mb-6">
        <h1 class="oscps" style="color:white;">OSCPS</h1>
    </div>
    <div class="text-center bg-gray-200 p-4 rounded shadow mb-4 ">
        <div class="title">
            <div class="text">Olá,</div>
            <div class="text">Esperamos que esteja bem.
                <br> Estamos entrando em contato para informá-lo,
                <br> sobre uma atualização importante em seu processo.
            </div>
            <br>
            @if($reservation)
            <div class="text">
                A reserva da quadra poliesportiva,
                <br>Com a data para o dia {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }},
                <br>No horário {{ \Carbon\Carbon::parse($reservation->date)->format('H:i:s') }} foi {{ $action }}.
            </div>
            <br>
            <div class="text">
                Status atual:
                <span class="font-bold 
                    @if($reservation->status == 2)
                        text-green-600  <!-- Para status 'aceito' -->
                    @elseif($reservation->status == 3)
                        text-red-600    <!-- Para status 'recusado' -->
                    @endif">
                    @if($reservation->status == 2)
                    Aceito
                    @elseif($reservation->status == 3)
                    Recusado
                    @endif
                </span>
            </div>
            @elseif($called)
            <div class="text">
                O seu chamado com ID#{{ $called->id }}
                <br>teve seu status atualizado para <br> 
                <span class="font-bold 
                    @if($called->status == 2)
                        text-yellow-500  <!-- Para status 'Em andamento' -->
                    @elseif($called->status == 3)
                        text-green-600   <!-- Para status 'Concluído' -->
                    @endif">
                    @if($called->status == 2)
                    Em andamento
                    @elseif($called->status == 3)
                    Concluído
                    @endif
                </span>.
                <br>Criado em: {{ \Carbon\Carbon::parse($called->created_at)->format('d/m/Y') }}.
                <br>Local: {{ $called->environment }}.
            </div>
            <br>
            <div class="text">
                
            </div>
            @endif
            <br>
            <div class="text">Gostaríamos de agradecer pela sua colaboração e confiança.
                <br>Sua participação é fundamental para a nossa instituição.
            </div>
            <br>
            <div class="text">Atenciosamente, OSPCS</div>
            <div class="text">Equipe do Sistema</div>
        </div>
    </div>
</body>

</html>