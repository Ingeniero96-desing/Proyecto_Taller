<div class="container mt-5">
    <h2 class="mb-4 seccion-titulo">
    <i class="bi bi-people-fill me-2"></i>Lista de Perfiles
    </h2>

    <a href="<?= base_url('/perfiles/crear') ?>" class="btn btn-primary mb-3">Agregar Perfil</a>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Perfil</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($perfiles as $perfil): ?>
                <tr>
                    <td><?= $perfil['id'] ?></td>
                    <td><?= $perfil['nombre_perfil'] ?></td>
                    <td>
                        <a href="<?= base_url('/perfiles/editar/' . $perfil['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="<?= base_url('/perfiles/eliminar/' . $perfil['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este perfil?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
