<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function vehicleFormValues(array $vehicle = []): array
{
    return [
        'make' => $vehicle['make'] ?? '',
        'model' => $vehicle['model'] ?? '',
        'year' => $vehicle['year'] ?? '',
        'vin' => $vehicle['vin'] ?? '',
        'price' => $vehicle['price'] ?? '',
        'status' => $vehicle['status'] ?? 'available',
    ];
}

function validateVehicle(array $input): array
{
    $values = [
        'make' => trim((string) ($input['make'] ?? '')),
        'model' => trim((string) ($input['model'] ?? '')),
        'year' => trim((string) ($input['year'] ?? '')),
        'vin' => strtoupper(trim((string) ($input['vin'] ?? ''))),
        'price' => trim((string) ($input['price'] ?? '')),
        'status' => trim((string) ($input['status'] ?? 'available')),
    ];

    $errors = [];

    if ($values['make'] === '') {
        $errors[] = 'Make is required.';
    }

    if ($values['model'] === '') {
        $errors[] = 'Model is required.';
    }

    $currentYear = (int) date('Y') + 1;
    if ($values['year'] === '' || !ctype_digit($values['year']) || (int) $values['year'] < 1900 || (int) $values['year'] > $currentYear) {
        $errors[] = 'Enter a valid vehicle year.';
    }

    if ($values['price'] === '' || !is_numeric($values['price']) || (float) $values['price'] < 0) {
        $errors[] = 'Enter a valid price.';
    }

    $allowedStatuses = ['available', 'sold', 'maintenance'];
    if (!in_array($values['status'], $allowedStatuses, true)) {
        $errors[] = 'Choose a valid status.';
    }

    return [$values, $errors];
}
