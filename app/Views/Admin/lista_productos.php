<section class="container my-5">
    <h2 class="text-center mb-4">Consultas Recibidas</h2>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($consultas)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Asunto</th>
                        <th>Consulta</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $consulta): ?>
                        <tr>
                            <td><?= $consulta['id_mensaje'] ?></td>
                            <td><?= esc($consulta['nombre']) ?></td>
                            <td><?= esc($consulta['email']) ?></td>
                            <td><?= esc($consulta['asunto']) ?></td>
                            <td><?= esc($consulta['consulta']) ?></td>
                            <td>
                                <?= isset($consulta['nombre']) && isset($consulta['apellido']) ? esc($consulta['nombre'] . ' ' . $consulta['apellido']) : 'No asignado' ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('consultas/editar/' . $consulta['id_mensaje']) ?>" class="btn btn-sm btn-warning me-2">Editar</a>
                                <form action="<?= base_url('consultas/eliminar/' . $consulta['id_mensaje']) ?>" method="post" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta consulta?');">
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay consultas registradas.</p>
    <?php endif; ?>
</section>