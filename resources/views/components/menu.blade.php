<!DOCTYPE html>
<html lang="en">

<head>
    <title>Exported Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-zR2Th/03XTt10T0E8pQ4r/0j+3zSqyNi+4XceIByKWCqOKP4hX4KA1sb0L+89u+3rfrN6Q/C571zWKCrzDNC4nWNp6ZrP/zii0S0RngDIw" crossorigin="anonymous" />

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #842519;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: center; /* Centraliza o conteúdo no cabeçalho */
            align-items: center;
            position: relative; /* Necessário para posicionar os elementos */
            z-index: 10; /* Garante que o cabeçalho fique acima do conteúdo */
        }

        .header-icons {
            position: absolute; /* Posiciona os ícones à direita */
            right: 20px;
            display: flex;
            align-items: center;
        }

        .sidebar {
            position: fixed;
            top: 100px; /* Aumenta o valor para 100px */
            left: 0; /* Mantém à esquerda */
            width: 250px; /* Largura do menu */
            height: calc(100vh - 100px); /* Altura para não cobrir o cabeçalho */
            background-color: #842519;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Permite rolagem se o conteúdo exceder a altura */
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
            background-color: #731f12; /* Cor ao passar o mouse */
        }

        .sidebar img {
            margin-left: auto;
            height: 24px; /* Tamanho do ícone */
            width: 24px; /* Tamanho do ícone */
        }

        .content {
            margin-left: 250px; /* Espaço para o menu lateral */
            padding: 20px;
            padding-top: 20px; /* Espaço extra no topo para não cobrir o cabeçalho */
        }
    </style>
</head>

<body>

<header class="header bg-gray-800 text-white p-6 min-h-[240px]">
  <div class="grid grid-cols-1 md:grid-cols-2 items-center justify-between gap-4">
    <!-- Título -->
    <div class="title-container text-center md:text-left mb-6 md:mb-0">
      <span class="oscps text-xl font-bold">OSCPS</span>
    </div>

    <!-- Ícones de navegação e Logout -->
    <div class="header-icons flex justify-center md:justify-center items-center space-x-6 space-y-4 md:space-y-0 mt-12 md:mt-0">
      <i class="fas fa-search-plus" id="zoom-in" title="Zoom In"></i>
      <i class="fas fa-search-minus" id="zoom-out" title="Zoom Out"></i>
      <i class="fas fa-sun toggle" title="Toggle Theme"></i>

      <!-- Formulário de logout sem alterações no design -->
      <form class="a" action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="fas fa-sign-out-alt logout-icon" title="Logout" id="logout-button"
          style="background-color: #842519; color: white; cursor: pointer; transition: none;">
        </button>
      </form>
    </div>
  </div>
</header>


    <div class="sidebar">
        <a href="/Teacher/dashboard" class="flex items-center">
            <span>Dashboard</span>
            <img src="public/external/dashboard-icon.svg" alt="Dashboard Icon" />
        </a>
        <a href="/Teacher/notification" class="flex items-center">
            <span>Notificações</span>
            <img src="public/external/notifications-icon.svg" alt="Notifications Icon" />
        </a>
        <a href="/Teacher/history" class="flex items-center">
            <span>Histórico</span>
            <img src="public/external/history-icon.svg" alt="History Icon" />
        </a>
        <a href="/logout" class="flex items-center">
            <span>Logout</span>
            <img src="public/external/history-icon.svg" alt="Logout Icon" />
        </a>
    </div>

    <div class="content">
        <!-- Conteúdo principal aqui -->
    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    </script>
</body>

</html>
