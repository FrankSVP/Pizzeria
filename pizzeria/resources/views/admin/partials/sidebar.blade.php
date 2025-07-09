<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pizzería</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Menú desplegable Parte superior -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTopMenu"
            aria-expanded="true" aria-controls="collapseTopMenu">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manejo de Usuarios</span>
        </a>
        <div id="collapseTopMenu" class="collapse" aria-labelledby="headingTopMenu" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('tipousuario.index') }}">Tipo de Usuarios</a>
                <a class="collapse-item" href="{{ route('usuario.index') }}">Usuarios</a>

            </div>
        </div>
    </li>

    <!-- Menú desplegable Parte superior -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTopMenu1"
            aria-expanded="true" aria-controls="collapseTopMenu">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manejo de Productos</span>
        </a>
        <div id="collapseTopMenu1" class="collapse" aria-labelledby="headingTopMenu" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('tipoproducto.index') }}">Tipos de Productos</a>


            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('cliente.index') }}">
            <i class="fas fa-user-friends"></i>
            <span>Clientes</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Botón de colapsar -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>