<h2>Editar Usuario</h2>

<form action="<?= base_url('/usuarios/actualizar/'.$usuario['id']) ?>" method="post">
    <label>Nombre: <input type="text" name="nombre" value="<?= esc($usuario['nombre']) ?>"></label><br>
    <label>Apellido: <input type="text" name="apellido" value="<?= esc($usuario['apellido']) ?>"></label><br>
    <label>Email: <input type="email" name="email" value="<?= esc($usuario['email']) ?>"></label><br>
    <label>Teléfono: <input type="text" name="telefono" value="<?= esc($usuario['telefono']) ?>"></label><br>
    <label>Contraseña (solo si deseas cambiarla): <input type="password" name="pass"></label><br>
    <label>Baja: <input type="text" name="baja" value="<?= esc($usuario['baja']) ?>"></label><br>
    <label>Perfil:
        <select name="id_perfil">
            <?php foreach($perfiles as $perfil): ?>
                <option value="<?= $perfil['id'] ?>" <?= $perfil['id'] == $usuario['id_perfil'] ? 'selected' : '' ?>>
                    <?= esc($perfil['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Actualizar</button>
</form>
</body>
</html>
