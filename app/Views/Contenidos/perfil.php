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
        <h2 class="mb-4 seccion-titulo text-center">
            <i class="bi bi-basket3-fill me-2"></i>Historial de Compras
        </h2>

        <!-- Buscador -->
        <div class="mb-3">
            <input type="text" id="buscadorCompras" class="form-control" placeholder="Buscar en tus compras...">
        </div>

        <table class="table table-bordered table-striped table-hover" id="tabla-compras">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID Compra</th>
                    <th>Fecha</th>
                    <th>Productos</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ventas)): ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td class="text-center"><?= esc($venta['id_venta']) ?></td>
                            <td class="text-center"><?= esc($venta['fecha_venta']) ?></td>
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
                        <td colspan="4" class="text-center">Aún no realizaste ninguna compra.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- 🔍 Buscador en tiempo real para compras -->
    <script>
        document.getElementById("buscadorCompras").addEventListener("keyup", function() {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll("#tabla-compras tbody tr");

            filas.forEach(fila => {
                const texto = fila.innerText.toLowerCase();
                fila.style.display = texto.includes(filtro) ? "" : "none";
            });
        });
    </script>
<?php endif; ?>