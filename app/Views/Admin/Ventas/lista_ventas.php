<div class="container mt-5">
    <h2 class="mb-4 border-bottom seccion-titulo">
        <i class="bi bi-receipt me-2"></i>Lista de Ventas
    </h2>

    <?php foreach (array_reverse($ventas) as $venta): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">🧾 Venta #<?= esc($venta['id_venta']) ?> |
                    <div class="text-white text-center">
                        <small>Fecha: <?= esc($venta['fecha_venta']) ?></small> |
                        <small>Usuario: <?= esc($venta['nombre_usuario']) ?></small>
                    </div>
                </h5>
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
</div>