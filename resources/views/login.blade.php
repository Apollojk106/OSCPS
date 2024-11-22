<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body style="background-color: #B30000; color: white;">
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

    <div class="container">
        <form action="{{route('studentlogin')}}" class="form active" id="admin-form" method="POST">
            @csrf
            <div class="sign-up">
                <div class="title">
                    <div class="text">Log-in Alunos</div>
                </div>
                <div class="subtitle">
                    <div class="text">Use seu RM ou email corporativo.</div>
                </div>
                <div class="text-field-outlined">
                    <input type="email" name="email" class="input-text w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Usuário" required>
                </div>
                <div class="text-field-outlined-error">
                    <input type="password" name="password" class="input-text w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Senha" required>
                </div>
                <div class="contained-button">
                    <button type="submit" class="label w-full p-3 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors duration-300">Entre no Site</button>
                </div>
                
                <a href="/register" class="administrativo-secretaria hover:underline hover:text-red-300 transition duration-300">Cadastro</a>
                <a href="/forgot-password" class="administrativo-secretaria hover:underline hover:text-red-300 transition duration-300">Esqueceu a Senha</a>
                <a href="#" id="toggle-teacher" class="administrativo-secretaria hover:underline hover:text-red-300 transition duration-300">Trocar para Educacional/Acadêmico</a>
                
            </div>
        </form>

        <form action="{{route('teacherlogin')}}" class="form" id="teacher-form" method="POST" style="display:none;">
    @csrf
    <div class="sign-up">
        <div class="title ">
            <div class="text">Log-in Corpo Docente</div>
        </div>
        <div class="subtitle">
            <div class="text">Use seu email corporativo.</div>
        </div>
        @if ($errors->any())
        <div class="bg-red-600 text-black p-4 mb-4 rounded-md">
            <strong>Atenção!</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="text-field-outlined">
            <input type="email" name="email" id="email" class="input-text w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Usuário" required>
        </div>
        <div class="text-field-outlined-error">
            <input type="password" name="password" id="password" class="input-text w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700" placeholder="Senha" required>
        </div>
        <div class="contained-button">
            <button type="submit" class="text-white w-full p-3  rounded-md flex items-center justify-center cursor-pointer hover:bg-red-800 hover:text-white transition-colors duration-300">
                Entre no Site
            </button>
        </div>

        <a href="#" id="toggle-admin" class="administrativo-secretaria hover:underline hover:text-red-300 transition duration-300 mt-4 block text-center">
            Trocar para Administrativo/Secretaria
        </a>
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