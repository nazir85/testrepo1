<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/helpers.php';

$pageTitle = 'Vehicles';
$statement = $pdo->prepare('SELECT id, make, model, year, vin, price, status, created_at FROM vehicles ORDER BY created_at DESC, id DESC');
$statement->execute();
$vehicles = $statement->fetchAll();

require_once __DIR__ . '/../../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Vehicles</h1>
    <a class="btn btn-primary" href="/vehicles/add.php">Add Vehicle</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <?php if ($vehicles === []): ?>
            <p class="text-muted mb-0">No vehicles have been added yet.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>VIN</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <tr>
                            <td><?= e((string) $vehicle['year']); ?></td>
                            <td><?= e($vehicle['make']); ?></td>
                            <td><?= e($vehicle['model']); ?></td>
                            <td><?= e($vehicle['vin']); ?></td>
                            <td>$<?= e(number_format((float) $vehicle['price'], 2)); ?></td>
                            <td><span class="badge text-bg-secondary"><?= e(ucfirst($vehicle['status'])); ?></span></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="/vehicles/edit.php?id=<?= e((string) $vehicle['id']); ?>">Edit</a>
                                <a class="btn btn-sm btn-outline-danger" href="/vehicles/delete.php?id=<?= e((string) $vehicle['id']); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
