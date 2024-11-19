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

    /* Modificações Tailwind para a sidebar */
    .sidebar {
      position: fixed;
      top: 100px;
      left: 0;
      width: 250px;
      height: calc(100vh - 100px);
      background-color: #701a0e;
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
      background-color: #731f12;
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
        padding: 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Header Fixo no topo -->
  <header class="bg-[#701a0e] text-white p-6 min-h-[100px] fixed top-0 left-0 w-full z-50">
    <div class="grid grid-cols-1 md:grid-cols-2 items-center justify-between gap-4 relative">
      <!-- Título -->
      <div class="title-container text-center md:text-left mb-6 md:mb-0">
        <span class="oscps text-xl font-bold">OSCPS</span>
      </div>

      <!-- Ícones de navegação e Logout -->
      <div class="header-icons flex justify-center md:justify-center items-center space-x-6 space-y-4 md:space-y-0 mt-12 md:mt-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
        </svg>



        
        <i class="fas fa-search-minus" id="zoom-out" title="Zoom Out"></i>
        <i class="fas fa-sun toggle" title="Toggle Theme"></i>


      </div>
    </div>
  </header>

  <!-- Botão para abrir/fechar a sidebar (aparece apenas em telas pequenas) -->
  <button id="menu-toggle" class="xl:hidden fixed top-4 left-[-70px]  z-50 text-white p-3">
    <i class="fas fa-bars"></i> <!-- Ícone de menu -->
  </button>

  <!-- Sidebar Fixa -->
  <div id="sidebar" class="sidebar">
    <a href="/Teacher/dashboard" class="flex items-center justify-between space-x-2">
      <span>Dashboard</span>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M3 12h18M3 19h18" />
      </svg>
    </a>
    <a href="/Teacher/notification" class="flex items-center justify-between space-x-2">
      <span>Notificações</span>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
      </svg>
    </a>
    <a href="/Teacher/history" class="flex items-center justify-between space-x-2">
      <span>Histórico</span>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 4M21 12c0-4.97-4.03-9-9-9S3 7.03 3 12s4.03 9 9 9c4.12 0 7.68-2.57 9-6" />
      </svg>
    </a>
    <a href="/Teacher/config" class="flex items-center justify-between space-x-2">
      <span>Configurações</span>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
      </svg>
    </a>
    <a href="/logout" class="flex items-center justify-between space-x-2">
      <span>Logout</span>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
      </svg>
    </a>
  </div>

  <!-- Conteúdo Principal -->
  <div class="content">
    <!-- Seu conteúdo vai aqui -->
  </div>

  <script>
    // Script para abrir e fechar a sidebar
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('open'); // Alterna a classe 'open' para mostrar ou ocultar a sidebar
    });
  </script>

</body>

</html>