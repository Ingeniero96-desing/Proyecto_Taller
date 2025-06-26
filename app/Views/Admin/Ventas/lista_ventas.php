<div class="container mt-4">
    <h2 class="mb-4 border-bottom seccion-titulo">
        <i class="bi bi-receipt me-2"></i>Lista de Ventas
    </h2>

    <!-- Buscador -->
    <div class="mb-3">
        <input type="text" id="buscadorVentas" class="form-control" placeholder="Buscar">
    </div>

    <table class="table table-bordered table-striped table-hover" id="tabla-ventas">
        <thead class="table-dark text-center">
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Productos</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ventas)) : ?>
                <?php foreach (array_reverse($ventas) as $venta): ?>
                    <tr>
                        <td class="text-center"><?= esc($venta['id_venta']) ?></td>
                        <td class="text-center"><?= esc($venta['fecha_venta']) ?></td>
                        <td class="text-center"><?= esc($venta['nombre_usuario']) ?></td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($venta['detalles'] as $detalle): ?>
                                    <li>
                                        <strong><?= esc($detalle['nombre_producto']) ?></strong>
                                        (Cantidad: <?= esc($detalle['detalle_cantidad']) ?>) -
                                        $<?= number_format($detalle['detalle_precio'], 2, ',', '.') ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary fs-6">
                                $<?= number_format($venta['total'], 2, ',', '.') ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay ventas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- 🔍 Buscador en tiempo real -->
<script>
    document.getElementById("buscadorVentas").addEventListener("keyup", function() {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll("#tabla-ventas tbody tr");

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();
            fila.style.display = texto.includes(filtro) ? "" : "none";
        });
    });
</script>