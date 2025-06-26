<div class="container mt-4">
    <h2 class="mb-4 border-bottom seccion-titulo">
        <i class="bi bi-chat-left-text me-2"></i>Lista de Consultas
    </h2>


    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('mensaje') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <!-- 🔍 Buscador -->
    <div class="mb-3">
        <input type="text" id="buscador" class="form-control" placeholder="Buscar">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tabla-consultas">
            <thead class="table-primary">
                <tr class="text-center">
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
                        <tr class="text-center">
                            <td><?= esc($consulta['nombre_mensaje']) ?></td>
                            <td><?= esc($consulta['correo_mensaje']) ?></td>
                            <td><?= esc($consulta['asunto_mensaje']) ?></td>
                            <td style="max-width: 250px; word-wrap: break-word; white-space: normal;">
                                <?= esc($consulta['consulta_mensaje']) ?>
                            </td>
                            <td><?= esc($consulta['nombre']) . ' ' . esc($consulta['apellido']) ?></td>
                            <td>
                                <a href="<?= base_url('consultas/marcar_leido/' . $consulta['id_mensaje']) ?>" class="btn btn-sm btn-success">Leído</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-muted text-center">No hay consultas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-3 text-end">
        <a href="<?= base_url('consultas_leidas') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-envelope-open"></i> Consultas Leídas
        </a>
    </div>
</div>

<!-- 🔧 Script para buscador en tiempo real -->
<script>
    document.getElementById("buscador").addEventListener("keyup", function() {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll("#tabla-consultas tbody tr");

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();
            fila.style.display = texto.includes(filtro) ? "" : "none";
        });
    });
</script>