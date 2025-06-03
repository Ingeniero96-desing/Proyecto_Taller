<div class="d-flex justify-content-center align-items-center vh-100 fondo-principal">
    <div class="bg-white p-5 rounded-5 text-secondary shadow login-container" style="width: 25rem;">

         
        <?php if (!empty($validation)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($validation as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if(session('error')){
            echo session('error');
        } ?>
                           
        <form action="<?= base_url('loguear') ?>" method="post">

            <!-- Icono de login centrado -->
            <div class="d-flex justify-content-center">
                <img src="<?= base_url('assets/img/login-icon.svg') ?>" alt="login-icon" style="height: 7rem">
            </div>

            <!-- Título del formulario -->
            <div class="text-center fs-1 fw-semibold">Iniciar sesión</div>

            <!-- Campo email: debe coincidir con el nombre esperado en $request->getPost('email') en el controlador -->
            <div class="input-group mt-4">
                <span class="input-group-text">
                    <i class="bi bi-person-fill"></i>
                </span>
                <input
                    class="form-control bg-light"
                    type="email"
                    name="email"
                    placeholder="Correo electrónico"
                    
                >
            </div>
            <?php if (session()->getFlashdata('validation')['email'] ?? false): ?>
                <div class="text-danger mt-1" style="font-size: 0.9rem;">
                    <?= session()->getFlashdata('validation')['email'] ?>
                </div>
            <?php endif; ?>

            <!-- Campo contraseña: debe coincidir con el nombre esperado en $request->getPost('pass') -->
            <div class="input-group mt-1">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input
                    class="form-control bg-light"
                    type="password"
                    name="pass"
                    placeholder="Contraseña"
                    
                >
            </div>
            <?php if (session()->getFlashdata('validation')['pass'] ?? false): ?>
                <div class="text-danger mt-1" style="font-size: 0.9rem;">
                    <?= session()->getFlashdata('validation')['pass'] ?>
                </div>
            <?php endif; ?>

            <!-- Checkbox "Recuérdame" (puedes manejarlo luego en el controlador para mantener sesión) -->
            <!-- <div class="d-flex justify-content-around mt-1">
                <div class="d-flex align-items-center gap-1">
                    <input class="form-check-input" type="checkbox" name="remember">
                    <div class="pt-1" style="font-size: 0.9rem">Recuérdame</div>
                </div>
                <div class="pt-1">
                    <a href="#" class="text-decoration-none text-info fw-semibold login-links"
                        style="font-size: 0.9rem;">¿Olvidó su contraseña?
                    </a>
                </div>
            </div> -->

            <!-- Botón para enviar el formulario -->
            <button
                type="submit"
                class="btn text-white w-100 mt-4 fw-semibold shadow-sm boton-inicio-sesion">
                Iniciar sesión
            </button>

            <!-- Link para registro de nuevos usuarios -->
            <div class="d-flex gap-1 justify-content-center mt-1">
                <div>¿No tienes una cuenta?</div>
                <a href="<?= base_url('registrate') ?>" class="text-decoration-none text-info fw-semibold login-links">Regístrate</a>
            </div>

            <!-- Separador visual para otros métodos de login -->
            <div class="p-3">
                <div class="border-bottom text-center" style="height: 0.9rem">
                    <span class="bg-white px-3">O también</span>
                </div>
            </div>

            <!-- Botón para login con Google (no está funcional por defecto, requiere integración OAuth) -->
            <div class="btn d-flex gap-2 justify-content-center border mt-3 shadow-sm">
                <img src="<?= base_url('assets/img/google-icon.svg') ?>" alt="google-icon" style="height: 1.6rem">
                <div class="fw-semibold text-secondary">Continuar con Google</div>
            </div>
        </form>
    </div>
</div>