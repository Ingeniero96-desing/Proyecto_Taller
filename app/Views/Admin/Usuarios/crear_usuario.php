<h2>Crear Usuario</h2>

<?php if (session()->get('validation')): ?>
    <ul>
        <?php foreach(session()->get('validation') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="<?= base_url('/usuarios/guardar') ?>" method="post">
    <label>Nombre: <input type="text" name="nombre" value="<?= old('nombre') ?>"></label><br>
    <label>Apellido: <input type="text" name="apellido" value="<?= old('apellido') ?>"></label><br>
    <label>Email: <input type="email" name="email" value="<?= old('email') ?>"></label><br>
    <label>Teléfono: <input type="text" name="telefono" value="<?= old('telefono') ?>"></label><br>
    <label>Contraseña: <input type="password" name="pass"></label><br>
    <label>Baja: <input type="text" name="baja" value="<?= old('baja') ?>"></label><br>
    <label>Perfil:
        <select name="id_perfil">
            <?php foreach($perfiles as $perfil): ?>
                <option value="<?= $perfil['id'] ?>"><?= esc($perfil['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Guardar</button>
</form>
</body>
</html>
