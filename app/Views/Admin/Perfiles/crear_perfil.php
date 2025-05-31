<div class="container mt-5">
    <h2>Crear Perfil</h2>
    <form action="<?= base_url('/perfiles/guardar') ?>" method="post">
        <div class="form-group">
            <label for="nombre_perfil">Nombre del Perfil:</label>
            <input type="text" name="nombre_perfil" class="form-control" value="<?= old('nombre_perfil') ?>">
            <?php if (session('validation')['nombre_perfil'] ?? false): ?>
                <small class="text-danger"><?= session('validation')['nombre_perfil'] ?></small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="<?= base_url('/perfiles') ?>" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
