            <nav class="navbar navbar-expand-lg mi-navbar">
                <div class="container-fluid">
                  <a class="navbar-brand" href="<?php echo base_url('principal') ?>">
                      <img class="imagen__logo" src="<?php echo base_url('/assets/img/logodenav.png') ?>">
                  </a>

                  <!--Pantalla pequeña (celulares o tablets), menú completo se oculta -->
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('informacion_de_contactos') ?>">Ver consultas</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="<?php echo base_url('comercializacion') ?>">Listar productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('quienes_somos') ?>">Listar ventas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('terminos_y_usos') ?>">Registrar libro</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('terminos_y_usos') ?>">Gestionar libros</a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?php echo base_url('perfil') ?>"> <!--metodo perfil en controlador usuario -->
                                    <?= session()->get('nombre') ?>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?php echo base_url('logout') ?>">Salir</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>