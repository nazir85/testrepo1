# testrepo1

Test repo 1

## Vehicle Inventory Test Module

This branch adds a simple plain PHP vehicle inventory module. It is intentionally not Laravel yet.

### Requirements

- PHP 8.1 or newer
- MySQL or MariaDB
- PDO MySQL extension enabled

### Database setup

1. Create the database and table:

   ```bash
   mysql -u root -p < database/vehicles.sql
   ```

2. Configure database access with environment variables. Do not commit real passwords.

   ```bash
   set DB_DSN=mysql:host=127.0.0.1;dbname=vehicle_inventory;charset=utf8mb4
   set DB_USER=root
   set DB_PASSWORD=
   ```

   On macOS or Linux, use `export` instead of `set`.

The app defaults to `mysql:host=127.0.0.1;dbname=vehicle_inventory;charset=utf8mb4`, user `root`, and an empty password for local testing only.

### Run locally

From the repository root, start PHP's built-in server with the `public` directory as the document root:

```bash
php -S localhost:8000 -t public
```

Open `http://localhost:8000/vehicles/index.php`.

### Pages

- `public/vehicles/index.php` lists vehicles.
- `public/vehicles/add.php` adds vehicles.
- `public/vehicles/edit.php` edits vehicles.
- `public/vehicles/delete.php` deletes vehicles after confirmation.

### Navigation

The shared header includes a responsive Bootstrap navbar, active page highlighting, a quick `New Vehicle` action, and breadcrumbs on vehicle pages.

All database reads and writes use PDO prepared statements, and the UI uses Bootstrap 5 from a CDN.
