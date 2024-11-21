<header class="header bg-gray-800 text-white p-6 min-h-[240px] fixed top-0 left-0 w-full z-50">
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
          style="background-color: #B30000; color: white; cursor: pointer; transition: none;">
        </button>
      </form>
    </div>
  </div>
</header>

<!-- Sidebar (agora oculto em todas as telas) -->
<div class="sidebar hidden md:hidden lg:hidden xl:hidden 2xl:hidden">
  <!-- Aqui vai o conteúdo da sidebar, mas ela será ocultada com a classe "hidden" -->
</div>
