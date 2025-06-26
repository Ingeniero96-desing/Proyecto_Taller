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

    <!-- Buscador -->
    <div class="mb-3">
        <input type="text" id="buscador" class="form-control" placeholder="Buscar">
    </div>

    <table class="table table-bordered table-striped table-hover" id="tabla-usuarios">
        <thead class="table-primary">
            <tr class="text-center">
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
                    <tr class="text-center">
                        <td><?= esc($usuario['id']) ?></td>
                        <td><?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?></td>
                        <td><?= esc($usuario['email']) ?></td>
                        <td><?= esc($usuario['telefono']) ?></td>
                        <td><?= esc($usuario['perfil']) ?></td>
                        <td class="text-center">
                            <?= $usuario['baja'] == '1' ? '<span class="badge bg-danger">Inactivo</span>' : '<span class="badge bg-success">Activo</span>' ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('editar_usuario/' . $usuario['id']) ?>" class="btn btn-sm btn-secondary">Editar</a>
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


<!-- 🔧 Script para buscador en tiempo real -->
<script>
    document.getElementById("buscador").addEventListener("keyup", function() {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll("#tabla-usuarios tbody tr");

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();
            fila.style.display = texto.includes(filtro) ? "" : "none";
        });
    });
</script>