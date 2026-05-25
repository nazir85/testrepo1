<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Vehicle Inventory';
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$breadcrumbs = $breadcrumbs ?? [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/vehicles/index.php">Vehicle Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $currentPath === '/vehicles/index.php' || $currentPath === '/' ? 'active' : ''; ?>" href="/vehicles/index.php">Vehicles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPath === '/vehicles/add.php' ? 'active' : ''; ?>" href="/vehicles/add.php">Add Vehicle</a>
                </li>
            </ul>
            <a class="btn btn-outline-light btn-sm" href="/vehicles/add.php">New Vehicle</a>
        </div>
    </div>
</nav>
<main class="container pb-5">
    <?php if ($breadcrumbs !== []): ?>
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <?php foreach ($breadcrumbs as $breadcrumb): ?>
                    <?php if (!empty($breadcrumb['url'])): ?>
                        <li class="breadcrumb-item"><a href="<?= e($breadcrumb['url']); ?>"><?= e($breadcrumb['label']); ?></a></li>
                    <?php else: ?>
                        <li class="breadcrumb-item active" aria-current="page"><?= e($breadcrumb['label']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </nav>
    <?php endif; ?>
