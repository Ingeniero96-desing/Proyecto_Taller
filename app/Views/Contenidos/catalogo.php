<section class="container my-5">
    <h1 class="mb-3 seccion-titulo">
        <i class="bi bi-journal-bookmark-fill me-2"></i>Catálogo de productos
    </h1>

    <!-- Buscador -->
    <form class="mb-4" method="get" action="<?= base_url('catalogo') ?>">
        <div class="input-group">
            <input type="text" class="form-control" name="busqueda" placeholder="Buscar producto..." value="<?= esc($busqueda ?? '') ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Botones de navegación por categorías -->
    <?php if (isset($productosPorCategoria) && !empty($productosPorCategoria)): ?>
        <div class="mb-4">
            <?php foreach ($productosPorCategoria as $categoria => $productos): ?>
                <a href="#<?= url_title($categoria, '-', true) ?>" class="btn btn-outline-dark me-2 mb-2"><?= esc($categoria) ?></a>
            <?php endforeach; ?>
        </div>

        <hr>

        <?php foreach ($productosPorCategoria as $categoria => $productos): ?>
            <div class="titulos-container mt-5" id="<?= url_title($categoria, '-', true) ?>">
                <p class="titulos" style="font-weight: bold;"><?= esc($categoria) ?></p>
            </div>

            <!-- Ajuste de grilla a 4 columnas -->
            <div class="cards-container row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php foreach (array_filter($productos, fn($p) => $p['estado_producto'] != 1) as $producto): ?>
                    <div class="col">
                        <div class="card custom-card h-100">
                            <div class="img-container">
                                <img src="<?= base_url('assets/uploads/' . $producto['imagen_producto']) ?>" class="card-img-top" alt="<?= esc($producto['nombre_producto']) ?>">
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><?= esc($producto['nombre_producto']) ?></h5>
                                    <p class="card-text"><?= esc($producto['descripcion_producto']) ?></p>

                                    <!-- NUEVO: Precio -->
                                    <p class="card-text mb-1">
                                        <strong>Precio:</strong> $<?= esc(number_format($producto['precio_producto'], 2, ',', '.')) ?>
                                    </p>

                                    <!-- NUEVO: Stock -->
                                    <?php if ($producto['stock_producto'] > 0): ?>
                                        <p class="card-text text-success mb-2">
                                            <strong>Stock:</strong> <?= esc($producto['stock_producto']) ?> unidades
                                        </p>
                                    <?php else: ?>
                                        <p class="card-text text-danger mb-2">
                                            <strong>Sin stock</strong>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <?php if ($producto['stock_producto'] == '0'): ?>
                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                            <span class="badge bg-secondary d-flex align-items-center justify-content-center p-2" style="width: 100px; height: 35px">Sin stock</span>
                                        </div>
                                    <?php else: ?>
                                        <?php if (session()->get('logueado')): ?>
                                            <form action="<?= base_url('carrito/agregar') ?>" method="post">
                                                <input type="hidden" name="id_productos" value="<?= esc($producto['id_producto']) ?>">
                                                <input type="hidden" name="nombre_producto" value="<?= esc($producto['nombre_producto']) ?>">
                                                <input type="hidden" name="precio_producto" value="<?= esc($producto['precio_producto']) ?>">
                                                <input type="hidden" name="descripcion_producto" value="<?= esc($producto['descripcion_producto']) ?>">
                                                <input type="hidden" name="imagen_producto" value="<?= esc($producto['imagen_producto']) ?>">

                                                <div class="d-flex justify-content-center align-items-center mt-2">
                                                    <button type="submit" class="btn btn-success">Agregar al carrito 🛒</button>
                                                </div>
                                            </form>
                                        <?php else: ?>
                                            <div class="d-flex justify-content-center align-items-center mt-2">
                                                <a href="<?= base_url('login') ?>" class="btn btn-warning">Inicia sesión para comprar 🛒</a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="lineas-separadoras">
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning">
            No hay productos para mostrar<?= isset($busqueda) ? ' con el término <strong>' . esc($busqueda) . '</strong>' : '' ?>.
        </div>
    <?php endif; ?>
</section>