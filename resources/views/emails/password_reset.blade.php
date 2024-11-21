<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="background-color: #B30000; color: white;">
    <div class="title text-center mb-6">
        <h1 class="oscps" style="color:white;">OSCPS</h1>
    </div>
    <div class="text-center bg-gray-200 p-4 rounded shadow mb-4 ">
        <div class="title">
            <div class="text">Olá,</div>
            <div class="text">Recebemos uma solicitação para redefinir sua senha.
                <br> Clique no link abaixo para criar uma nova senha:</div>

            <div class="flex justify-center items-center">
                <form action="{{ $resetLink }}" method="get" target="_blank">
                    <div class="contained-button">
                        <button type="submit" class="label">Redefinir a senha</button>
                    </div>
                </form>
            </div>

            <div class="text">Se você não fez essa solicitação, por favor ignore este e-mail.</div>
            <div class="text">Atenciosamente,</div>
            <div class="text">Equipe do Sistema</div>
        </div>
    </div>
</body>

</html>