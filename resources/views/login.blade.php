<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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

<body style="background-color: #FF161F; color: white;">

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

    <div class="container">
        <form action="{{route('post.login')}}" class="form active" id="admin-form" method="POST">
            @csrf
            <div class="sign-up">
                <div class="title">
                    <div class="text">Log-in</div>
                </div>
                <div class="subtitle">
                    <div class="text">Use seu RM ou email corporativo.</div>
                </div>
                <div class="text-field-outlined">
                    <input type="text" name="login" class="input-text w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Usuário" required>
                </div>
                <div class="text-field-outlined-error">
                    <input type="password" name="password" class="input-text w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Senha" required>
                </div>
                <div class="contained-button">
                    <button type="submit" class="label w-full p-3 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors duration-300">Entre no Site</button>
                </div>

                <a href="/register" class="administrativo-secretaria hover:underline hover:text-red-300 transition duration-300">Cadastro</a>
                <a href="/forgot-password" class="administrativo-secretaria hover:underline hover:text-red-300 transition duration-300">Esqueceu a Senha</a>           

            </div>
        </form>
    </div>

    <script>
        const toggleAdmin = document.getElementById('toggle-admin');
        const toggleTeacher = document.getElementById('toggle-teacher');
        const adminForm = document.getElementById('admin-form');
        const teacherForm = document.getElementById('teacher-form');

        toggleAdmin.addEventListener('click', (e) => {
            e.preventDefault();
            adminForm.style.display = 'block';
            teacherForm.style.display = 'none';
        });

        toggleTeacher.addEventListener('click', (e) => {
            e.preventDefault();
            teacherForm.style.display = 'block';
            adminForm.style.display = 'none';
        });
    </script>
</body>



</html>