<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/helpers.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect('/vehicles/index.php');
}

$statement = $pdo->prepare('SELECT id, make, model, year FROM vehicles WHERE id = :id');
$statement->execute([':id' => $id]);
$vehicle = $statement->fetch();

if (!$vehicle) {
    redirect('/vehicles/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statement = $pdo->prepare('DELETE FROM vehicles WHERE id = :id');
    $statement->execute([':id' => $id]);

    redirect('/vehicles/index.php');
}

$pageTitle = 'Delete Vehicle';
require_once __DIR__ . '/../../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Delete Vehicle</h1>
    <a class="btn btn-outline-secondary" href="/vehicles/index.php">Back</a>
</div>

<div class="alert alert-warning">
    Are you sure you want to delete <?= e((string) $vehicle['year']); ?> <?= e($vehicle['make']); ?> <?= e($vehicle['model']); ?>?
</div>

<form method="post" class="d-flex gap-2">
    <button class="btn btn-danger" type="submit">Delete Vehicle</button>
    <a class="btn btn-outline-secondary" href="/vehicles/index.php">Cancel</a>
</form>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
