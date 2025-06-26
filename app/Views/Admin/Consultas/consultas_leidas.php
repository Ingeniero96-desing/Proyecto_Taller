<div class="container mt-4">
    <h2 class="mb-4 border-bottom seccion-titulo">
        <i class="bi bi-envelope-open me-2"></i>Consultas Leídas
    </h2>

    <!-- 🔍 Buscador -->
    <div class="mb-3">
        <input type="text" id="buscadorLeidas" class="form-control" placeholder="Buscar">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tabla-consultas-leidas">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($consultas_leidas)): ?>
                    <?php foreach ($consultas_leidas as $consulta): ?>
                        <tr class="text-center">
                            <td><?= esc($consulta['nombre_mensaje']) ?></td>
                            <td><?= esc($consulta['correo_mensaje']) ?></td>
                            <td><?= esc($consulta['asunto_mensaje']) ?></td>
                            <td style="max-width: 250px; word-wrap: break-word; white-space: normal;">
                                <?= esc($consulta['consulta_mensaje']) ?>
                            </td>
                            <td><?= esc($consulta['nombre']) . ' ' . esc($consulta['apellido']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-muted text-center">No hay consultas leídas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- 🔁 Botón para volver a consultas no leídas -->
    <div class="mt-3 text-end">
        <a href="<?= base_url('consultas') ?>" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left-circle"></i> Volver a consultas no leídas
        </a>
    </div>
</div>

<!-- 🔧 Script buscador -->
<script>
    document.getElementById("buscadorLeidas").addEventListener("keyup", function() {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll("#tabla-consultas-leidas tbody tr");

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();
            fila.style.display = texto.includes(filtro) ? "" : "none";
        });
    });
</script>