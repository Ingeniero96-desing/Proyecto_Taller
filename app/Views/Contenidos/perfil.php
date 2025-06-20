<div class="container mt-4">
    <h2 class="mb-5 seccion-titulo">
    <i class="bi bi-person-circle me-2"></i>Mi Perfil
    </h2>


   <div class="card p-4 mb-3 shadow">
    <h5><i class="bi bi-person-fill me-2 text-primary"></i>Nombre completo</h5>
    <p><?= session()->get('nombre') ?> <?= session()->get('apellido') ?></p>
    </div>

    <div class="card p-4 mb-3 shadow">
        <h5><i class="bi bi-envelope-fill me-2 text-primary"></i>Correo electrónico</h5>
        <p><?= session()->get('email') ?></p>
    </div>

    <div class="card p-4 mb-3 shadow">
        <h5><i class="bi bi-telephone-fill me-2 text-primary"></i>Teléfono</h5>
        <p><?= session()->get('telefono') ?></p>
    </div>

</div>

<?php if (session()->get('id_perfil') == 2): ?>
    <div class="container mt-5">
        <h2 class="mb-5 seccion-titulo text-center">
            <i class="bi bi-basket3-fill me-2"></i>Historial de Compras
        </h2>

        <?php if (!empty($ventas)): ?>
            <?php foreach ($ventas as $venta): ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-dark text-white text-center">
                        <h5 class="mb-0 text-white">🧾 Compra #<?= esc($venta['id_venta']) ?></h5>
                        <div>
                            <small>Fecha: <?= esc($venta['fecha_venta']) ?></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($venta['detalles'] as $detalle): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        🛒 <strong><?= esc($detalle['nombre_producto']) ?></strong>
                                        (Cantidad: <?= esc($detalle['detalle_cantidad']) ?>)
                                    </span>
                                    <span class="badge bg-success">
                                        $<?= number_format($detalle['detalle_precio'], 2, ',', '.') ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="mt-3 text-end">
                            <strong>Total: </strong>
                            <span class="badge bg-primary fs-6">
                                $<?= number_format($venta['total'], 2, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Aún no realizaste ninguna compra.
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

