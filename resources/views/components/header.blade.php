<!-- resources/views/components/header.blade.php -->
<header class="header">
    <span class="oscps">OSCPS</span>
    <div class="header-icons" style="align-items: center;">
        <i class="fas fa-search-plus" id="zoom-in" title="Zoom In"></i>
        <i class="fas fa-search-minus" id="zoom-out" title="Zoom Out"></i>
        <i class="fas fa-sun toggle" title="Toggle Theme"></i>     
        <form class="a" action="{{ route('logout') }}" method="POST"> 
            @csrf
            <button class="fas fa-sign-out-alt logout-icon" title="Logout" id="logout-button" 
            style="background-color: #842519; color: white; cursor: pointer; transition: none;">
            </button>
        </form>           
    </div>
</header>