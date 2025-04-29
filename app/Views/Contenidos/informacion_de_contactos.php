    <section class="container my-5 contacto-seccion">
        <h2 class="text-center mb-5 seccion-titulo">Información de Contacto</h2>

        <div class="row g-4 mb-5">
            <div class="col-md-6 contacto-card p-4">
                <h5 class="fw-bold text-primary">Nombre del titular:</h5>
                <p>Horacio Pagani</p>
                <h5 class="fw-bold text-primary">Razón social:</h5>
                <p>Soluciones Web SRL</p>
                <h5 class="fw-bold text-primary">Domicilio legal:</h5>
                <p>Av. Siempreviva 742, Ciudad Autónoma de Buenos Aires</p>
            </div>
            <div class="col-md-6 contacto-card p-4">
                <h5 class="fw-bold text-primary">Teléfonos:</h5>
                <p>+54 11 1234-5678 / +54 9 11 8765-4321</p>
                <h5 class="fw-bold text-primary">Email:</h5>
                <p>modparts@gmail.com</p>
                <h5 class="fw-bold text-primary">Redes sociales:</h5>
                <p>
                    <a href="https://facebook.com/tuusuario" class="enlace-red">Facebook</a> · 
                    <a href="https://instagram.com/tuusuario" class="enlace-red">Instagram</a> · 
                    <a href="https://linkedin.com" class="enlace-red">LinkedIn</a>
                </p>
            </div>
        </div>

        <h2 class="text-center mb-4 seccion-titulo">Formulario de Contacto</h2>

        <form class="shadow p-4 rounded bg-white">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombreInput" placeholder="Tu nombre" required>
                <label for="nombreInput">Nombre completo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="emailInput" placeholder="nombre@ejemplo.com" required>
                <label for="emailInput">Correo electrónico</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="motivoSelect" required>
                    <option selected disabled value="">Seleccioná una opción</option>
                    <option value="consulta">Consulta general</option>
                    <option value="presupuesto">Solicitud de presupuesto</option>
                    <option value="soporte">Soporte técnico</option>
                    <option value="otro">Otro</option>
                </select>
                <label for="motivoSelect">Motivo de contacto</label>
            </div>
            <div class="form-floating mb-4">
                <textarea class="form-control" id="mensajeTextarea" placeholder="Escribí tu mensaje acá" style="height: 150px" required></textarea>
                <label for="mensajeTextarea">Mensaje</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">Enviar mensaje</button>
            </div>
        </form>
    </section>