<div class="container mt-5">
    <h2>Lista de Consultas</h2>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Asunto</th>
                <th>Mensaje</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($consultas)): ?>
                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <td><?= esc($consulta['nombre_mensaje']) ?></td>
                        <td><?= esc($consulta['correo_mensaje']) ?></td>
                        <td><?= esc($consulta['asunto_mensaje']) ?></td>
                        <td><?= esc($consulta['consulta_mensaje']) ?></td>
                        <td><?= esc($consulta['nombre']) . ' ' . esc($consulta['apellido']) ?></td>
                        <td>
                            <a href="<?= base_url('consultas/editar/' . $consulta['id_mensaje']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            
                            <form action="<?= base_url('consultas/eliminar/' . $consulta['id_mensaje']) ?>" method="post" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta consulta?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No hay consultas registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
