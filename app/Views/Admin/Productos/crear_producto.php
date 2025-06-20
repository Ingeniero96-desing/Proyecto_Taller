<div class="container mt-4">
    <h2 class="mb-4">Agregar Nuevo Producto</h2>

    <?php if (session()->getFlashdata('validation')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('validation') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('crear_producto') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre_producto" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="<?= old('nombre_producto') ?>">
        </div>

        <div class="mb-3">
            <label for="descripcion_producto" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion_producto" name="descripcion_producto" value="<?= old('descripcion_producto') ?>">
        </div>

        <div class="mb-3">
            <label for="precio_producto" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio_producto" name="precio_producto" value="<?= old('precio_producto') ?>">
        </div>

        <div class="mb-3">
            <label for="stock_producto" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock_producto" name="stock_producto" value="<?= old('stock_producto') ?>">
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-control" id="id_categoria" name="id_categoria">
                <option value="">-- Selecciona una categoría --</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= esc($categoria['id_cate']) ?>" <?= old('id_categoria') == $categoria['id_cate'] ? 'selected' : '' ?>>
                        <?= esc($categoria['nombre_categoria']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen_producto" class="form-label">Imagen (URL o nombre de archivo)</label>
            <input type="file" class="form-control" id="imagen_producto" name="imagen_producto" accept="image/*" value="<?= old('imagen_producto') ?>">
        </div>

        <button type="submit" class="btn btn-success">Guardar Producto</button>
        <a href="<?= base_url('productos') ?>" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>