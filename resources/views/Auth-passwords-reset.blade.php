<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Troca de Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="background-color: #842519; color: white;">

    

    <!-- Container para centralizar o formulário -->
    <div class="flex items-center justify-center min-h-screen">
        

        <!-- Formulário com fundo branco e bordas arredondadas -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            <h1 class="oscps" style="color:white;">OSCPS</h1>

            <div class="title text-center mb-6">
                <div class="text">Solicitar Troca de Senha</div>
            </div>

            <!-- Formulário de solicitação de troca de senha -->
            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Campo de e-mail -->
                <div>
                    <input
                        type="email"
                        name="email"
                        placeholder="E-mail"
                        class="input-text"
                        required>
                </div>

                <!-- Campo de nova senha -->
                <div>
                    <input
                        type="password"
                        name="password"
                        placeholder="Nova Senha"
                        class="input-text"
                        required>
                </div>

                <!-- Campo de confirmação de senha -->
                <div>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirmar Senha"
                        class="input-text"
                        required>
                </div>

                <!-- Botão de submissão -->
                <div>
                    <button
                        type="submit"
                        class="w-full p-3 bg-red-900 text-white rounded-lg hover:bg-red-700 transition duration-300">
                        Redefinir Senha
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="/login" class="administrativo-secretaria">Voltar para o login</a>
            </div>
        </div>

    </div>

</body>

</html>