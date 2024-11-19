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
</head>


<body style="background-color: #842519; color: white; overflow: hidden;">

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
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input
                        type="email"
                        name="email"
                        placeholder="Informe seu e-mail"
                        class="input-text"
                        required>
                </div>
                <div class="mb-4">
                    <button
                        type="submit"
                        class="w-full p-3 bg-red-900 text-white rounded-lg hover:bg-red-700 transition duration-300">
                        Enviar link
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