<div class="container mt-4">
    <h2 class="mb-4 border-bottom seccion-titulo">
        <i class="bi bi-person-badge-fill me-2"></i>Lista de Usuarios
    </h2>


    <?php if (session('mensaje')): ?>
        <div class="alert alert-success"><?= session('mensaje') ?></div>
    <?php endif; ?>

    <?php if (session('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>


    <table class="table table-bordered table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)) : ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= esc($usuario['id']) ?></td>
                        <td><?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?></td>
                        <td><?= esc($usuario['email']) ?></td>
                        <td><?= esc($usuario['telefono']) ?></td>
                        <td><?= esc($usuario['perfil']) ?></td>
                        <td>
                            <?= $usuario['baja'] == '1' ? '<span class="badge bg-danger">Inactivo</span>' : '<span class="badge bg-success">Activo</span>' ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('editar_usuario/' . $usuario['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="<?= base_url('/usuarios/eliminar/' . $usuario['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>