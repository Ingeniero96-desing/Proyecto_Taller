<section class="container my-5 contacto-seccion">
    <h2 class="text-center mb-5 seccion-titulo">
        <i class="bi bi-telephone-fill me-2"></i>Información de Contacto
    </h2>

    <div class="row g-4 mb-5">
        <div class="col-md-6 contacto-card p-4">
            <h5 class="fw-bold text-primary"><i class="bi bi-person-fill me-2"></i>Nombre del titular:</h5>
            <p>Horacio Pagani</p>
            <h5 class="fw-bold text-primary"><i class="bi bi-building me-2"></i>Razón social:</h5>
            <p>Soluciones Web SRL</p>
            <h5 class="fw-bold text-primary"><i class="bi bi-geo-alt-fill me-2"></i>Domicilio legal:</h5>
            <p>Av. Siempreviva 742, Ciudad Autónoma de Buenos Aires</p>
        </div>
        <div class="col-md-6 contacto-card p-4">
            <h5 class="fw-bold text-primary"><i class="bi bi-telephone-fill me-2"></i>Teléfonos:</h5>
            <p>+54 11 1234-5678 / +54 9 11 8765-4321</p>
            <h5 class="fw-bold text-primary"><i class="bi bi-envelope-fill me-2"></i>Email:</h5>
            <p>modparts@gmail.com</p>
            <h5 class="fw-bold text-primary"><i class="bi bi-share-fill me-2"></i>Redes sociales:</h5>
            <p>
                <a href="https://facebook.com/tuusuario" class="enlace-red"><i class="bi bi-facebook me-1"></i>Facebook</a> ·
                <a href="https://instagram.com/tuusuario" class="enlace-red"><i class="bi bi-instagram me-1"></i>Instagram</a> ·
                <a href="https://linkedin.com" class="enlace-red"><i class="bi bi-linkedin me-1"></i>LinkedIn</a>
            </p>
        </div>
    </div>


    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>

    <?php $validation = session('validation'); ?>
    <?php if (!empty($validation)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($validation as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <h2 class="text-center mb-5 seccion-titulo">¡Envíanos tu consulta!</h2>

    <form action="<?= base_url('crearConsulta') ?>" method="post" class="shadow p-4 rounded bg-white">
        <?= csrf_field() ?>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="nombre_mensaje" id="nombreInput" placeholder="Tu nombre" value="<?= old('nombre_mensaje') ?>">
            <label for="nombreInput">Nombre completo</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="correo_mensaje" id="emailInput" placeholder="nombre@ejemplo.com" value="<?= old('correo_mensaje') ?>">
            <label for="emailInput">Correo electrónico</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" name="asunto_mensaje" id="motivoSelect">
                <option disabled value="">Seleccioná una opción</option>
                <option value="consulta" <?= old('asunto_mensaje') == 'consulta' ? 'selected' : '' ?>>Consulta general</option>
                <option value="presupuesto" <?= old('asunto_mensaje') == 'presupuesto' ? 'selected' : '' ?>>Solicitud de presupuesto</option>
                <option value="soporte" <?= old('asunto_mensaje') == 'soporte' ? 'selected' : '' ?>>Soporte técnico</option>
                <option value="otro" <?= old('asunto_mensaje') == 'otro' ? 'selected' : '' ?>>Otro</option>
            </select>
            <label for="motivoSelect">Motivo de contacto</label>
        </div>

        <div class="form-floating mb-4">
            <textarea class="form-control" name="consulta_mensaje" id="mensajeTextarea" placeholder="Escribí tu mensaje acá" style="height: 150px"><?= old('consulta_mensaje') ?></textarea>
            <label for="mensajeTextarea">Mensaje</label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">Enviar mensaje</button>
        </div>
    </form>

</section>