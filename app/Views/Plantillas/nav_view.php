<?php
$perfil = session()->get('id_perfil');
?>

<?php if (!$perfil): ?>
    <nav class="navbar navbar-expand-lg mi-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('principal') ?>">
                <img class="imagen__logo" src="<?php echo base_url('/assets/img/logodenav.png') ?>" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php $uri = service('uri'); ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($uri->getSegment(1) == 'informacion_de_contactos') ? 'active' : '' ?>"
                            href="<?= base_url('informacion_de_contactos') ?>">Contacto</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link <?= ($uri->getSegment(1) == 'comercializacion') ? 'active' : '' ?>"
                            href="<?= base_url('comercializacion') ?>">Comercialización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($uri->getSegment(1) == 'quienes_somos') ? 'active' : '' ?>"
                            href="<?= base_url('quienes_somos') ?>">Quiénes somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($uri->getSegment(1) == 'terminos_y_usos') ? 'active' : '' ?>"
                            href="<?= base_url('terminos_y_usos') ?>">Términos y Condiciones</a>
                    </li>
                </ul>


                <!-- Botones de registro y login -->
                <div class="d-flex flex-column flex-sm-row align-items-center gap-2">
                    <a href="<?= base_url('registro') ?>" class="btn btn-primary flex-fill text-white fw-bold text-center">
                        Registrarse
                    </a>
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-light flex-fill fw-bold text-center">
                        Iniciar Sesión
                    </a>
                </div>


                <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            </div>
        </div>
    </nav>

<?php elseif ($perfil == 1): ?>
    <?= view('Plantillas/nav_admin') ?>

<?php elseif ($perfil == 2): ?>
    <?= view('Plantillas/nav_cliente') ?>

<?php endif; ?>