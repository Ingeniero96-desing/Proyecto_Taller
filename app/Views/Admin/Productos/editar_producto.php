<div class="container">
    <h2>Editar Producto</h2>

    <?php if (session('validation')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('validation') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= base_url('/productos/actualizar/' . $producto['id']) ?>" method="post">
        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre_producto" value="<?= esc($producto['nombre_producto']) ?>">
        </div>
        <div>
            <label>Descripción:</label>
            <input type="text" name="descripcion_producto" value="<?= esc($producto['descripcion_producto']) ?>">
        </div>
        <div>
            <label>Precio:</label>
            <input type="text" name="precio_producto" value="<?= esc($producto['precio_producto']) ?>">
        </div>
        <div>
            <label>Stock:</label>
            <input type="number" name="stock_producto" value="<?= esc($producto['stock_producto']) ?>">
        </div>
        <div>
            <label>Categoría:</label>
            <input type="text" name="categoria_producto" value="<?= esc($producto['categoria_producto']) ?>">
        </div>
        <button type="submit">Actualizar</button>
    </form>
</div>
