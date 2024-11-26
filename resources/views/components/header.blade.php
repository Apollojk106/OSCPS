<script src="https://cdn.jsdelivr.net/npm/heroicons@1.0.5/outline.min.js"></script>

<header class="header text-white p-6 min-h-[240px] fixed top-0 left-0 w-full z-50 bg-gray-800 shadow-lg">
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
          style="background-color: #FF161F; color: white; cursor: pointer; transition: none;">
        </button>
      </form>
    </div>
  </div>
</header>

<style>
  .header {
    /* Adicionando uma sombra ao header */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  }
</style>