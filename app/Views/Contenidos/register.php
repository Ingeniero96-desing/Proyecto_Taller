    <div class="d-flex justify-content-center align-items-center vh-100 registrarme-fondo">
        <div class="bg-white p-5 rounded-5 text-secondary shadow">
            <div class="registrarme-titulos text-center">
                <i class="bi bi-person-circle fs-1 text-primary mb-3"></i>
                <h1>Creá una cuenta</h1>
                <h3>Es fácil y rápido.</h3>
            </div>

            <?php if (session()->getFlashdata('validation')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('validation') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <hr>
            <form action="<?= base_url('registro') ?>" method="post">
                <div class="nombre-ape">
                    <input class="input-nombre-ape bg-light" type="text" placeholder="Nombre" name="nombre" value="<?= old('nombre') ?>">
                    <input class="input-nombre-ape bg-light" type="text" placeholder="Apellido" name="apellido" value="<?= old('apellido') ?>">
                </div>
                <hr>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="number" class="form-control bg-light" placeholder="Teléfono" name="telefono" value="<?= old('telefono') ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control bg-light" placeholder="Correo electrónico" name="email" value="<?= old('email') ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control bg-light" placeholder="Contraseña" name="pass">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control bg-light" placeholder="Confirmar contraseña" name="confirm_pass">
                </div>

                <div class="text-center">
                    <a href="terminos_y_usos" class="text-decoration-none text-info fw-semibold R-links">Términos y Condiciones</a>
                </div>
                <button type="submit" class="btn text-white w-100 mt-3 mb-3 fw-semibold shadow-sm boton-crear">Crear cuenta</button>

            </form>
            <div class="text-center">
                <a href="<?= base_url('login') ?>" class="text-decoration-none text-info fw-semibold R-links">¿Ya tienes una cuenta?</a>
            </div>

        </div>
    </div>