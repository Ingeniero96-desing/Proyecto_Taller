<nav class="navbar navbar-expand-lg mi-navbar">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="<?= base_url('principal') ?>">
            <img class="imagen__logo" src="<?= base_url('/assets/img/logodenav.png') ?>" alt="Logo">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Links de navegación -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('informacion_de_contactos') ?>">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('comercializacion') ?>">Comercialización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('quienes_somos') ?>">Quiénes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('catalogo') ?>">Productos</a>
                </li>
            </ul>

            <!-- Botones de perfil y carrito -->
            <div class="d-flex flex-column flex-lg-row align-items-center gap-2">
                <a href="<?= base_url('carrito') ?>" class="btn btn-outline-light flex-fill text-center" title="Ver Carrito">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <a href="<?= base_url('perfil') ?>" class="btn btn-primary flex-fill text-white fw-bold text-center">
                    <?= session()->get('nombre') ?>
                </a>

                <a href="<?= base_url('logout') ?>" class="btn btn-outline-light flex-fill fw-bold text-center">
                    Cerrar Sesión
                </a>
            </div>

        </div>
    </div>
</nav>