<?php
$cart = \Config\Services::cart();
$items = $cart->contents();
?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2 class="mb-5 seccion-titulo text-center">
    <i class="bi bi-cart-fill me-2"></i><?= esc($titulo) ?>
    </h2>


    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= esc($item['name']) ?></td>
                            <td>$<?= esc($item['price']) ?></td>
                            <td>
                                <?= esc($item['qty']) ?>
                                <a href="<?= base_url('carrito/modificar/mas/' . $item['rowid']) ?>" class="btn btn-sm btn-secondary ms-2">+</a>
                                <a href="<?= base_url('carrito/modificar/menos/' . $item['rowid']) ?>" class="btn btn-sm btn-secondary ms-1">-</a>
                            </td>
                            <td>$<?= esc($item['subtotal']) ?></td>
                            <td>
                                <?php if (!empty($item['options']['imagen'])): ?>
                                    <img src="<?= base_url('assets/uploads/' . $item['options']['imagen']) ?>" width="60" class="img-thumbnail" />
                                <?php else: ?>
                                    <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('carrito/eliminar/' . $item['rowid']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">🛒 El carrito está vacío</td>
                    </tr>

                    <div class="mt-3">
                        <a href="<?= base_url('#productos-cliente') ?>" class="btn btn-outline-primary fw-semibold">
                            ➕ Agregar producto
                        </a>
                    </div>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($items)): ?>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4>Total: <span class="badge bg-secondary">$<?= $cart->total() ?></span></h4>
            <a href="<?= base_url('carrito/vaciar') ?>" class="btn btn-outline-danger fw-semibold">Vaciar carrito</a>
            <a href="<?= base_url('carrito/confirmar') ?>" method="post">
                <button type="submit" class="btn btn-outline-success fw-semibold">Confirmar compra ✅</button>
            </a>
        </div>

        <div class="mt-3">
            <a href="<?= base_url('#productos-cliente') ?>" class="btn btn-outline-primary fw-semibold">
                ➕ Agregar otro producto
            </a>
        </div>
    <?php endif; ?>
</div>

<hr>