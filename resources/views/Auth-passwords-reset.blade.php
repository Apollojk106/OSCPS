<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Troca de Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal-btn {
            padding: 14px 40px !important;
            /* Ajusta o tamanho do botão */
            font-size: 18px !important;
            /* Ajusta o tamanho da fonte */
            border-radius: 8px !important;
            /* Bordas arredondadas */
            width: 100% !important;
            /* Faz o botão ocupar 100% da largura do pop-up */
            box-sizing: border-box !important;
            /* Garantir que o padding seja incluído na largura */
        }

        /* Ajusta a largura do pop-up para que o conteúdo e o botão se ajustem */
        .swal2-popup {
            min-width: 300px !important;
            /* Definindo uma largura mínima */
            width: auto !important;
            /* Ajuste a largura automaticamente */
        }

        /* Ajusta a largura do conteúdo para que o botão acompanhe */
        .swal2-html-container {
            max-width: 100% !important;
            /* Ajusta a largura máxima do conteúdo */
        }
    </style>
</head>

<body style="background-color: #B30000; color: white; overflow: hidden;">
    <br>

@if(session('success'))
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta na tela
            icon: "success", // Tipo do ícone (sucesso)
            title: "{{ session('success') }}", // Mensagem que vem da sessão
            showConfirmButton: false, // Não mostra o botão de confirmação
            timer: 1500 // O alerta desaparece após 1.5 segundos
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta
            icon: 'error', // Ícone de erro
            title: 'Oops...', // Título do alerta
            html: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>', // Lista de erros
            showConfirmButton: true, // Mostra o botão de confirmação
            confirmButtonText: 'OK', // Texto do botão
            customClass: {
                confirmButton: 'swal-btn' // Classe customizada para o botão
            }
        });
    </script>
    @endif


<div class="title text-center mb-6">
    <h1 class="oscps" style="color:white;">OSCPS</h1>
</div>

    <!-- Container para centralizar o formulário -->
    <div class="flex items-center justify-center min-h-screen">
        

        <!-- Formulário com fundo branco e bordas arredondadas -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            
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