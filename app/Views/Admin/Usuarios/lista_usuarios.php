<h2>Lista de Usuarios</h2>

<?php if(session()->getFlashdata('mensaje')): ?>
    <p><?= session()->getFlashdata('mensaje') ?></p>
<?php endif; ?>

<table border="1">
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Perfil</th><th>Baja</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= esc($usuario['nombre']) ?></td>
                <td><?= esc($usuario['apellido']) ?></td>
                <td><?= esc($usuario['email']) ?></td>
                <td><?= esc($usuario['telefono']) ?></td>
                <td><?= esc($usuario['id_perfil']) ?></td>
                <td><?= esc($usuario['baja']) ?></td>
                <td>
                    <a href="<?= base_url('/usuarios/editar/'.$usuario['id']) ?>">Editar</a> |
                    <a href="<?= base_url('/usuarios/eliminar/'.$usuario['id']) ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
