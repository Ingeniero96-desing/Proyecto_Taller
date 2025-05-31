<div class="container">
    <h2>Lista de Productos</h2>

    <?php if (session('mensaje')): ?>
        <div class="alert alert-success"><?= session('mensaje') ?></div>
    <?php endif; ?>

    <a href="<?= base_url('/productos/crear') ?>">Agregar nuevo producto</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= esc($producto['id']) ?></td>
                    <td><?= esc($producto['nombre_producto']) ?></td>
                    <td><?= esc($producto['descripcion_producto']) ?></td>
                    <td><?= esc($producto['precio_producto']) ?></td>
                    <td><?= esc($producto['stock_producto']) ?></td>
                    <td><?= esc($producto['categoria_producto']) ?></td>
                    <td>
                        <a href="<?= base_url('/productos/editar/' . $producto['id']) ?>">Editar</a> |
                        <a href="<?= base_url('/productos/eliminar/' . $producto['id']) ?>"
                           onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
