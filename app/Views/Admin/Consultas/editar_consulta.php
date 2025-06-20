<div class="container mt-5">

   <?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('consultas/editar/' . $consultas['id_mensaje']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre_mensaje">Nombre</label>
            <input type="text" name="nombre_mensaje" class="form-control" value="<?= esc($consultas['nombre_mensaje']) ?>">
        </div>

        <div class="form-group">
            <label for="correo_mensaje">Correo Electrónico</label>
            <input type="email" name="correo_mensaje" class="form-control" value="<?= esc($consultas['correo_mensaje']) ?>">
        </div>

        <div class="form-group">
            <label for="asunto_mensaje">Asunto</label>
            <input type="text" name="asunto_mensaje" class="form-control" value="<?= esc($consultas['asunto_mensaje']) ?>">
        </div>

        <div class="form-group">
            <label for="consulta_mensaje">Consulta</label>
            <textarea name="consulta_mensaje" class="form-control" rows="5"><?= esc($consultas['consulta_mensaje']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>

        <a href="<?= base_url('consultas') ?>" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
