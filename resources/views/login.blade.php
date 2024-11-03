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
                    <input type="text" class="input-text" placeholder="Usuário" required>
                </div>
                <div class="text-field-outlined-error">
                    <input type="password" class="input-text" placeholder="Senha" required>
                </div>
                <div class="contained-button">
                    <button type="submit" class="label">Entre no Site</button>
                </div>
                <a href="/register" class="administrativo-secretaria">Cadastro</a>
                <a href="#" id="toggle-teacher" class="administrativo-secretaria">Trocar para Educacional/Acadêmico</a>
            </div>
        </form>

        <form action="{{route('teacherlogin')}}" class="form" id="teacher-form" method="POST" style="display:none;">
            @csrf
            <div class="sign-up">
                <div class="title">
                    <div class="text">Log-in Corpo Docente</div>
                </div>
                <div class="subtitle">
                    <div class="text">Use seu email corporativo.</div>
                </div>
                <div class="text-field-outlined">
                    <input type="text" class="input-text" placeholder="Usuário" required>
                </div>
                <div class="text-field-outlined-error">
                    <input type="password" class="input-text" placeholder="Senha" required>
                </div>
                <div class="contained-button">
                    <button type="submit" class="label">Entre no Site</button>
                </div>
                

                <a href="#" id="toggle-admin" class="administrativo-secretaria">Trocar para Administrativo/Secretaria</a>
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
