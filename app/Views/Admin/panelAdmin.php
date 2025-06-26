<div class="p-5">
    <h1 class="mb-5 seccion-titulo">
        <i class="bi bi-shield-lock-fill me-2"></i>Bienvenido al Panel de Administración, <?= session()->get('nombre') ?>.
    </h1>


    <!-- Botones grandes de acceso rápido -->
    <div class="row text-center">
        <div class="col-md-3 mb-4">
            <a href="<?= base_url('consultas') ?>" class="btn btn-lg p-4 shadow-sm w-100 text-white" style="background-color: #0d6efd; border-radius: 20px;">
                <i class="bi bi-chat-left-text fs-1 d-block mb-2"></i>
                Consultas
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="<?= base_url('productos') ?>" class="btn btn-lg p-4 shadow-sm w-100 text-white" style="background-color: #ffc107 ; border-radius: 20px;">
                <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                Productos
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="<?= base_url('ventas') ?>" class="btn btn-lg p-4 shadow-sm w-100 text-white" style="background-color:rgb(30, 150, 94); border-radius: 20px;">
                <i class="bi bi-currency-dollar fs-1 d-block mb-2"></i>
                Ventas
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="<?= base_url('lista_usuarios') ?>" class="btn btn-lg p-4 shadow-sm w-100 text-white" style="background-color:rgb(77, 90, 92); border-radius: 20px;">
                <i class="bi bi-people-fill fs-1 d-block mb-2"></i>
                Usuarios
            </a>
        </div>
    </div>

    <div id="logo-container">
        <img src="<?php echo base_url('/assets/img/modparts.png') ?>" alt="MODPARTS">
    </div>

</div>