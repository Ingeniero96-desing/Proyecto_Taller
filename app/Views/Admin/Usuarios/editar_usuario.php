<div class="container mt-4">
    <h2 class="mb-4">Editar Usuario</h2>

    <?php if (session()->getFlashdata('validation')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('validation') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('actualizar_usuario/' . $usuario['id']) ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= esc($usuario['nombre']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= esc($usuario['apellido']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($usuario['email']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?= esc($usuario['telefono']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Baja</label>
            <select name="baja" class="form-select">
                <option value="0" <?= $usuario['baja'] == '0' ? 'selected' : '' ?>>Activo</option>
                <option value="1" <?= $usuario['baja'] == '1' ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Perfil</label>
            <select name="id_perfil" class="form-select">
                <?php foreach ($perfiles as $perfil): ?>
                    <?php if (isset($perfil['id_perfiles'], $perfil['descripcion'])): ?>
                        <option value="<?= esc($perfil['id_perfiles']) ?>" <?= $perfil['id_perfiles'] == $usuario['id_perfil'] ? 'selected' : '' ?>>
                            <?= esc($perfil['descripcion']) ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="<?= base_url('/lista_usuarios') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>