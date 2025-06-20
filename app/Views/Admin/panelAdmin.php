<div class="p-5">
    <h1 class="mb-5 seccion-titulo">
        <i class="bi bi-shield-lock-fill me-2"></i>Bienvenido al Panel de Administración, <?= session()->get('nombre') ?>.
    </h1>


    <!-- Botones grandes de acceso rápido -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <a href="consultas" class="btn btn-primary btn-lg w-100">📋 Consultas</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="productos" class="btn btn-success btn-lg w-100">📦 Productos</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="ventas" class="btn btn-warning btn-lg w-100">💰 Ventas</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="lista_usuarios" class="btn btn-info btn-lg w-100">👥 Usuarios</a>
        </div>
    </div>

</div>