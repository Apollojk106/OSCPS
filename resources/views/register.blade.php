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

<body style="background-color: #842519; color: white;">
    <h1 class="oscps" style="color:white;">OSCPS</h1>
    <div class="container">



        <form action="{{ route('student.register') }}" class="form" id="teacher-register-form" method="POST">
            @csrf
            <div class="sign-up">
                <div class="title">
                    <div class="text">Cadastro</div>
                </div>



                <div class="text-field-outlined">
                    <input type="text" name="name" class="input-text" placeholder="Nome" required>
                </div>
                <div class="text-field-outlined">
                    <input type="text" name="RM" class="input-text" placeholder="RM" required>
                </div>
                <div class="text-field-outlined">
                    <input type="email" name="email" class="input-text" placeholder="Email" required>
                </div>
                <div class="text-field-outlined">
                    <input type="password" name="password" class="input-text" placeholder="Senha" required>
                </div>
                <div class="text-field-outlined">
                    <input type="password" name="password_confirmation" class="input-text" placeholder="Confirme a Senha" required>
                </div>
                <div class="contained-button">
                    <button type="submit" class="label">Cadastrar</button>
                </div>
                <a href="/login" class="administrativo-secretaria">Voltar para o Login</a>
            </div>
        </form>
    </div>

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