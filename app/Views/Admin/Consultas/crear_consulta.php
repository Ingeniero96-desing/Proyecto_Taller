<div class="container mt-5">
    <h2>Agregar Consulta</h2>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($validation as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/agregar-consulta') ?>" method="post">
        <div class="form-group">
            <label for="nombre_mensaje">Nombre</label>
            <input type="text" name="nombre_mensaje" class="form-control" value="<?= set_value('nombre_mensaje') ?>">
        </div>

        <div class="form-group">
            <label for="correo_mensaje">Correo electrónico</label>
            <input type="email" name="correo_mensaje" class="form-control" value="<?= set_value('correo_mensaje') ?>">
        </div>

        <div class="form-group">
            <label for="asunto_mensaje">Asunto</label>
            <input type="text" name="asunto_mensaje" class="form-control" value="<?= set_value('asunto_mensaje') ?>">
        </div>

        <div class="form-group">
            <label for="consulta_mensaje">Consulta</label>
            <textarea name="consulta_mensaje" class="form-control" rows="4"><?= set_value('consulta_mensaje') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
    </form>
</div>
