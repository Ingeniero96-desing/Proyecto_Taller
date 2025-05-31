    <div class="d-flex justify-content-center align-items-center vh-100 registrarme-fondo">
        <div class="bg-white p-5 rounded-5 text-secondary shadow">
            <div class="registrarme-titulos">
                <h1>Creá una cuenta</h1>
                <h3>Es fácil y rápido.</h3>
            </div>
            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('mensaje') ?>
                </div>
            <?php endif; ?>

            <?php if (session('validation')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session('validation') as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <hr>
            <form action="<?= base_url('registrate') ?>" method="post">
                <div class="nombre-ape">
                    <input class="input-nombre-ape bg-light" type="text" placeholder="Nombre" name="nombre" required value="<?= old('nombre') ?>">
                    <input class="input-nombre-ape bg-light" type="text" placeholder="Apellido" name="apellido" required value="<?= old('apellido') ?>">
                </div>
                <hr>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="number" class="form-control bg-light" placeholder="Teléfono" name="telefono" required value="<?= old('telefono') ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control bg-light" placeholder="Correo electrónico" name="email" required value="<?= old('email') ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control bg-light" placeholder="Contraseña" name="pass" required value="<?= old('pass') ?>">
                </div>

                <!-- <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control bg-light" placeholder="Confirmar contraseña" name="pass">
                </div> -->

                <div class="text-center">
                    <a href="#" class="text-decoration-none text-info fw-semibold R-links">Términos y Condiciones</a>
                </div>
                <button type="submit" class="btn text-white w-100 mt-3 mb-3 fw-semibold shadow-sm boton-crear">Crear cuenta</button>

            </form>
            <div class="text-center">
                <a href="#" class="text-decoration-none text-info fw-semibold R-links">¿Ya tienes una cuenta?</a>
            </div>

        </div>
    </div>