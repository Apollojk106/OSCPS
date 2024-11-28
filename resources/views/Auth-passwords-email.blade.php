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


<body style="background-color: #cc1c22; color: white; overflow: hidden;">

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

    <br>

    <div class="title text-center mb-6">
        <h1 class="oscps" style="color:white;">OSCPS</h1>
    </div>

    
    <!-- Container para centralizar o formulário e garantir margens -->
    <div class="flex justify-center items-center p-4">

        <!-- Formulário com fundo branco, bordas arredondadas, responsivo e margem -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96 mx-4 ">

            <div class="title text-center mb-6">
                <div class="text">Solicitar Troca de Senha</div>
            </div>

            <!-- Formulário de solicitação de troca de senha -->
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input
                        type="email"
                        name="email"
                        placeholder="Informe seu e-mail"
                        class="text-black w-full p-3 border border-gray-300 rounded-lg"
                        required>
                </div>
                <div class="mb-4">
                    <button
                        type="submit"
                        class="w-full p-3 text-white rounded-lg focus:outline-none">
                        Enviar link
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="/login" class="text-red-700 hover:underline">Voltar para o login</a>
            </div>
        </div>

    </div>

</body>


</html>