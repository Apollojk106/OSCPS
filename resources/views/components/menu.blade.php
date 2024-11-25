<!DOCTYPE html>
<html lang="en">

<head>
  <title>Exported Project</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-zR2Th/03XTt10T0E8pQ4r/0j+3zSqyNi+4XceIByKWCqOKP4hX4KA1sb0L+89u+3rfrN6Q/C571zWKCrzDNC4nWNp6ZrP/zii0S0RngDIw" crossorigin="anonymous" />

  <!-- Tailwind CSS (importando via CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .sidebar {
      position: fixed;
      top: 130px;
      left: 0;
      width: 250px;
      height: calc(100vh - 130px);
      background-color: #B30000;
      color: white;
      padding: 20px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      overflow-y: auto;
      transition: transform 0.3s ease-in-out;
    }

    /* Adicionando a classe para ocultar a sidebar em telas menores */
    .sidebar.hidden {
      transform: translateX(-100%);
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 10px;
      text-decoration: none;
      color: white;
      border-radius: 5px;
      margin-bottom: 10px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #B30000;
    }

    .sidebar img {
      margin-left: auto;
      height: 24px;
      width: 24px;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
      padding-top: 0px;
    }

    /* Responsividade para a sidebar em telas pequenas */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        z-index: 1000;
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .content {
        margin-left: 0;
        /* Remova a margem quando a sidebar estiver aberta */
        padding: 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Header Fixo no topo -->
  <header class="header text-white p-6 min-h-[100px] fixed top-0 left-0 w-full z-50">
    <div class="grid grid-cols-3 items-center justify-between gap-4">
      <!-- Coluna vazia antes do OSCPS -->
      <div></div>

      <!-- Título (OSCPS) -->
      <div class="title-container flex justify-center mb-6 md:mb-0">
        <span class="oscps text-4xl font-bold">OSCPS</span>
      </div>

      <!-- Ícones de navegação e Logout -->
      <div class="header-icons flex flex-wrap justify-center items-center space-x-4 mt-16 md:mt-0">
        <i class="fas fa-search-plus text-2xl" title="Zoom In"></i>
        <i class="fas fa-search-minus text-2xl" title="Zoom Out"></i>
        <i class="fas fa-sun text-2xl toggle" title="Toggle Theme"></i>

        <!-- Formulário de logout -->
        <form action="{{ route('logout') }}" method="POST" class="flex items-center">
          @csrf
          <button class="fas fa-sign-out-alt logout-icon text-3xl" title="Logout" id="logout-button"
            style="background-color: #B30000; color: white; cursor: pointer; transition: none;">
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Botão para abrir/fechar a sidebar (aparece apenas em telas pequenas) -->
  <button id="menu-toggle" class="xl:hidden fixed top-4 left-[-70px]  z-50 text-white p-3">
    <i class="fas fa-bars"></i> <!-- Ícone de menu -->
  </button>

  <!-- Sidebar Fixa -->
  <div id="sidebar" class="sidebar">
    <a href="/Adm/dashboard" class="flex items-center justify-between space-x-2">
      <span>Dashboard</span>
      <i class="fa-solid fa-chart-line text-2xl"></i>
    </a>
    <a href="/Adm/notification" class="flex items-center justify-between space-x-2">
      <span>Notificações</span>
      <i class="fa-solid fa-bell text-2xl"></i>
    </a>
    <a href="/Adm/history" class="flex items-center justify-between space-x-2">
      <span>Histórico</span>
      <i class="fa-solid fa-clock-rotate-left text-2xl"></i>
    </a>
    <a href="/Adm/config" class="flex items-center justify-between space-x-2">
      <span>Configurações</span>
      <i class="fa-solid fa-gear text-2xl"></i>
    </a>
    <a href="/logout" class="flex items-center justify-between space-x-2">
      <span>Logout</span>
      <i class="fas fa-sign-out-alt logout-icon text-2xl"></i>
    </a>
  </div>

  <!-- Conteúdo Principal -->
  <div class="mt-14">
  </div>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const content = document.querySelector('.content'); // Selecione o conteúdo principal

    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('open'); // Alterna a classe 'open' para mostrar ou ocultar a sidebar

      // Ajusta a margem do conteúdo principal
      if (sidebar.classList.contains('open')) {
        content.style.marginLeft = '250px'; // Adiciona margem quando a sidebar está aberta
      } else {
        content.style.marginLeft = '0'; // Remove a margem quando a sidebar está fechada
      }
    });
  </script>

</body>

</html>