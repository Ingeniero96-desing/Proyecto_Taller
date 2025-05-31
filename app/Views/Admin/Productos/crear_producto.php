<div class="container">
    <h2>Agregar Producto</h2>

    <?php if (session('validation')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('validation') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= base_url('/productos/guardar') ?>" method="post">
        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre_producto" value="<?= old('nombre_producto') ?>">
        </div>
        <div>
            <label>Descripción:</label>
            <input type="text" name="descripcion_producto" value="<?= old('descripcion_producto') ?>">
        </div>
        <div>
            <label>Precio:</label>
            <input type="text" name="precio_producto" value="<?= old('precio_producto') ?>">
        </div>
        <div>
            <label>Stock:</label>
            <input type="number" name="stock_producto" value="<?= old('stock_producto') ?>">
        </div>
        <div>
            <label>Categoría:</label>
            <input type="text" name="categoria_producto" value="<?= old('categoria_producto') ?>">
        </div>
        <button type="submit">Guardar</button>
    </form>
</div>
