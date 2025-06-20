<nav class="navbar navbar-expand-lg mi-navbar">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img class="imagen__logo" src="<?= base_url('/assets/img/logodenav.png') ?>" alt="Logo">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Menú de navegación central -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('panelAdmin') ?>">Administrador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('consultas') ?>">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('productos') ?>">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('ventas') ?>">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('lista_usuarios') ?>">Usuarios</a>
                </li>
            </ul>

            <!-- Botones perfil y logout -->
            <div class="d-flex flex-column flex-lg-row align-items-center gap-2">
                <a href="<?= base_url('perfil') ?>">
                    <button type="button" class="btn btn-primary btn-sm btn-lg custom-btn w-100 w-lg-auto">
                        <?= session()->get('nombre') ?>
                    </button>
                </a>
                <a href="<?= base_url('logout') ?>">
                    <button type="button" class="btn btn-outline-light btn-sm btn-lg custom-btn-secondary w-100 w-lg-auto">
                        Cerrar Sesión
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>
