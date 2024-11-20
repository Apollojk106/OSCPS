<html>
    <body>
        <p>Olá,</p>
        @if($reservation)
            <p>A reserva de ID #{{ $reservation->id }} foi {{ $action }}.</p>
            <p>Status atual: {{ $reservation->status }}</p>
        @elseif($called)
            <p>O chamado #{{ $called->id }} teve seu status atualizado para "{{ $status }}".</p>
        @endif
        <p>Atenciosamente, OSPCS</p>
        <p>Equipe do Sistema</p>
    </body>
</html>
