<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <div class="subtitle">
                    <div class="text">Preencha suas informações.</div>
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
                <div class="contained-button">
                    <button type="submit" class="label">Cadastrar</button>
                </div>
                <a href="/login" class="administrativo-secretaria">Voltar para o Login</a>
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