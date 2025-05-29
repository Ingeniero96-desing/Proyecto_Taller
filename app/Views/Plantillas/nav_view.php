
          <nav class="navbar navbar-expand-lg mi-navbar">
              <div class="container-fluid">
                  <a class="navbar-brand" href="<?php echo base_url('principal') ?>">
                      <img class="imagen__logo" src="<?php echo base_url('/assets/img/logodenav.png') ?>">
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url('informacion_de_contactos') ?>">Contacto</a>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link" href="<?php echo base_url('comercializacion') ?>">Comercialización</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url('quienes_somos') ?>">Quiénes somos</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url('terminos_y_usos') ?>">Términos y Condiciones</a>
                          </li>
                      </ul>
                      <div class="botones-registrarse d-flex gap-3">
                        <a href="<?php echo base_url('registrate') ?>">
                            <button type="button" class="btn btn-primary btn-lg custom-btn">Registrarse</button>
                        </a>
                        <a href="<?php echo base_url('login') ?>">
                            <button type="button" class="btn btn-outline-light btn-lg custom-btn-secondary">Iniciar Sesión</button>
                        </a>
                      </div>

                      <!-- <form class="d-flex" role="search">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                      </form> -->
                  </div>
              </div>
          </nav>
  