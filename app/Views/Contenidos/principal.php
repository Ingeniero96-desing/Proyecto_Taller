      <section>
          <div id="logo-descripcion-container">
              <div id="logo-container">
                  <img src="<?php echo base_url('/assets/img/modparts.png') ?>" alt="MODPARTS">
              </div>
              <div id="descripcion-container">
                  <h3 class="titulos fw-bold">¿Qué Ofrecemos?</h3>

                  <p id="descripcion">Te ofrecemos una amplia variedad de productos de alta calidad para tu vehículo,
                      desde piezas esenciales para el motor hasta accesorios exclusivos que mejorarán
                      tanto su rendimiento como su estética. Contamos con repuestos originales y
                      componentes de última tecnología, diseñados para adaptarse a tus necesidades
                      y las de tu automóvil.
                  </p>
              </div>
          </div>

          <div class="fondo-carrusel">
              <p class="titulos" style="color: white;">Productos más vendidos</p>
              <div class="container-carrusel">
                  <div id="carruselProductos" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                          <div class="carousel-item active">
                              <img src="assets/img/fundasDeportivas.jpg" class="d-block" alt="Fundas deportivas">
                              <div class="carousel-caption">
                                  <h5>Fundas Deportivas</h5>
                                  <p>Funda Cubre Asiento Azul y Negro 9 Pc Sparco</p>
                              </div>
                          </div>

                          <div class="carousel-item">
                              <img src="assets/img/kitbujiaNGK.jpg" class="d-block" alt="Kit de bujias">
                              <div class="carousel-caption">
                                  <h5>Kit de bujias NGK</h5>
                                  <p>Kit x4 bujias marca NGK R Gol Trend Fox Suran Saveiro GNC</p>
                              </div>
                          </div>

                          <div class="carousel-item">
                              <img src="assets/img/kitLucesLed.jpg" class="d-block" alt="luces Led">
                              <div class="carousel-caption">
                                  <h5>Kit de Luces LED</h5>
                                  <p>Kit De Luces Led R8 12v Para Autos-Camionetas</p>
                              </div>
                          </div>

                          <div class="carousel-item">
                              <img src="assets/img/bobinasred.jpg" class="d-block" alt="Bobinas Red">
                              <div class="carousel-caption">
                                  <h5>Bobinas Red FTX</h5>
                                  <p>Kit x4 Bobinas Red FTX Plasma VW Passat tsi</p>
                              </div>
                          </div>

                          <div class="carousel-item">
                              <img src="assets/img/filtro.jpg" class="d-block" alt="Filtro de admision">
                              <div class="carousel-caption">
                                  <h5>Filtro de admisión</h5>
                                  <p>Filtro de aire universal de alto flujo original</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carruselProductos" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previo</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carruselProductos" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Siguiente</span>
                  </button>
              </div>
          </div>

          <hr class="lineas-separadoras">
          <?php if (isset($productosPorCategoria) && !empty($productosPorCategoria)): ?>
              <?php foreach ($productosPorCategoria as $categoria => $productos): ?>
                  <div class="titulos-container" id="productos-cliente">
                      <p class="titulos"><?= esc($categoria) ?></p>
                  </div>

                  <div class="cards-container">
                      <?php foreach (array_slice($productos, 0, 4) as $producto): ?>
                          <div class="card custom-card">
                              <div class="img-container">
                                  <img src="<?= base_url('assets/uploads/' . $producto['imagen_producto']) ?>" class="card-img-top" alt="<?= esc($producto['nombre_producto']) ?>">
                              </div>
                              <div class="card-body">
                                  <h5 class="card-title"><?= esc($producto['nombre_producto']) ?></h5>
                                  <p class="card-text"><?= esc($producto['descripcion_producto']) ?></p>
                                  <?php if (session()->get('logueado')): ?>
                                      <form action="<?= base_url('carrito/agregar') ?>" method="post">
                                          <input type="hidden" name="id_productos" value="<?= esc($producto['id_producto']) ?>">
                                          <input type="hidden" name="nombre_producto" value="<?= esc($producto['nombre_producto']) ?>">
                                          <input type="hidden" name="precio_producto" value="<?= esc($producto['precio_producto']) ?>">
                                          <input type="hidden" name="descripcion_producto" value="<?= esc($producto['descripcion_producto']) ?>">
                                          <input type="hidden" name="imagen_producto" value="<?= esc($producto['imagen_producto']) ?>">

                                          <div class="d-flex justify-content-center align-items-center">
                                              <button type="submit" class="btn btn-success">Agregar al carrito 🛒</button>
                                          </div>
                                      </form>
                                  <?php else: ?>
                                      <div class="d-flex justify-content-center align-items-center">
                                          <a href="<?= base_url('login') ?>" class="btn btn-warning">Inicia sesión para comprar 🛒</a>
                                      </div>
                                  <?php endif; ?>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  </div>

                  <hr class="lineas-separadoras">
              <?php endforeach; ?>
          <?php else: ?>
              <p>No hay productos para mostrar.</p>
          <?php endif; ?>

      </section>