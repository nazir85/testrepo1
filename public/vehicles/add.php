<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/helpers.php';

$pageTitle = 'Add Vehicle';
$errors = [];
$values = vehicleFormValues();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$values, $errors] = validateVehicle($_POST);

    if ($errors === []) {
        $statement = $pdo->prepare(
            'INSERT INTO vehicles (make, model, year, vin, price, status) VALUES (:make, :model, :year, :vin, :price, :status)'
        );
        $statement->execute([
            ':make' => $values['make'],
            ':model' => $values['model'],
            ':year' => (int) $values['year'],
            ':vin' => $values['vin'] !== '' ? $values['vin'] : null,
            ':price' => (float) $values['price'],
            ':status' => $values['status'],
        ]);

        redirect('/vehicles/index.php');
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Add Vehicle</h1>
    <a class="btn btn-outline-secondary" href="/vehicles/index.php">Back</a>
</div>

<?php if ($errors !== []): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= e($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="make">Make</label>
                <input class="form-control" id="make" name="make" value="<?= e($values['make']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="model">Model</label>
                <input class="form-control" id="model" name="model" value="<?= e($values['model']); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="year">Year</label>
                <input class="form-control" id="year" name="year" type="number" min="1900" max="<?= e((string) ((int) date('Y') + 1)); ?>" value="<?= e((string) $values['year']); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="vin">VIN</label>
                <input class="form-control" id="vin" name="vin" maxlength="17" value="<?= e($values['vin']); ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="price">Price</label>
                <input class="form-control" id="price" name="price" type="number" min="0" step="0.01" value="<?= e((string) $values['price']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status">
                    <?php foreach (['available' => 'Available', 'sold' => 'Sold', 'maintenance' => 'Maintenance'] as $status => $label): ?>
                        <option value="<?= e($status); ?>" <?= $values['status'] === $status ? 'selected' : ''; ?>><?= e($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Save Vehicle</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
