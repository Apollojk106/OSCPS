function imprimirOpcaoSelecionada() {
    const combobox = document.getElementById('Andar'); // Substitua 'meuComboBox' pelo ID do seu combobox
  
    combobox.addEventListener('change', function() {
      const valorSelecionado = this.value;
      alert('Você selecionou:', valorSelecionado);
    });
  }
  
  // Chame a função para iniciar a monitoração do combobox
  imprimirOpcaoSelecionada();

function showPage(pageId) {
    const pages = document.querySelectorAll('body > div');
    pages.forEach(page => {
        if (page.id === pageId) {
            page.style.display = 'flex';
        } else {
            page.style.display = 'none';
        }
    });
}

function toggleTheme() {
    document.body.classList.toggle('dark-theme');
}

function sendResetCode() {
    // Implementar a lógica para enviar código de redefinição de senha
    alert('Código enviado para redefinir a senha');
    showPage('login-page');
}

function changePassword() {
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (newPassword !== confirmPassword) {
        document.getElementById('password-error').style.display = 'block';
    } else {
        document.getElementById('password-error').style.display = 'none';
        alert('Senha trocada com sucesso!');
        showPage('login-page');
    }
}

function studentLogin() {
    // Implementar a lógica de login do aluno
    showPage('student-dashboard');
}

function teacherLogin() {
    // Implementar a lógica de login do professor
    showPage('teacher-dashboard');
}

document.getElementById('emergency-form').addEventListener('submit', function(e) {
    e.preventDefault();
    showNotification('emergency-notification');
});

document.getElementById('sports-form').addEventListener('submit', function(e) {
    e.preventDefault();
    showNotification('sports-notification');
});

function showNotification(notificationId) {
    const notification = document.getElementById(notificationId);
    notification.classList.add('show');
    setTimeout(() => {
        notification.classList.remove('show');
    }, 4000);
}

function logout() {
    showPage('login-page');
}

var valorSelecionado = document.getElementById("minha-combo").value;1