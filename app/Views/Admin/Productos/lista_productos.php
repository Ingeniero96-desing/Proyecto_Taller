<div class="container mt-4">
    <h2 class="mb-4 border-bottom seccion-titulo">
        <i class="bi bi-box-seam me-2"></i>Lista de Productos
    </h2>


    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('mensaje') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('crear_producto') ?>" class="btn btn-primary mb-3">Agregar nuevo producto</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)) : ?>
                    <?php foreach ($productos as $producto) : ?>
                        <tr class="text-center">
                            <td><?= esc($producto['id_producto']) ?></td>
                            <td>
                                <?php if ($producto['imagen_producto']): ?>
                                    <img src="<?= base_url('assets/uploads/' . $producto['imagen_producto']) ?>" alt="Imagen" style="max-width: 50px; max-height: 50px;">
                                <?php else: ?>
                                    <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($producto['nombre_producto']) ?></td>
                            <td><?= esc($producto['descripcion_producto']) ?></td>
                            <td>$<?= esc($producto['precio_producto']) ?></td>
                            <td><?= esc($producto['stock_producto']) ?></td>
                            <td><?= esc($producto['nombre_categoria']) ?></td>
                            <td class="text-center">
                                <?= $producto['estado_producto'] == '1' ? '<span class="badge bg-danger">Inactivo</span>' : '<span class="badge bg-success">Activo</span>' ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('editar_producto/' . $producto['id_producto']) ?>" class="btn btn-sm btn-secondary">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay productos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>