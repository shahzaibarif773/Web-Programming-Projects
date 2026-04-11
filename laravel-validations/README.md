## Stack

- PHP 8.2+
- Laravel 12
- MySQL (XAMPP)
- Composer (backend dependencies)
- Vite + npm (frontend assets)

## Features

- Customers CRUD (index, create, store, edit, update, destroy)
- Invoices CRUD (index, create, store, edit, update, destroy)
- Invoice list with customer name + status labels (`Billed`, `Paid`, `Void`)
- Invoice filter by customer
- Pagination for users, customers, and invoices
- Form Request validation
- Eloquent relationships:
  - Customer hasMany Invoice
  - Invoice belongsTo Customer
- Flash success/error messages
- Mass-assignment protection via `$fillable`
- CSRF-protected forms and escaped Blade output

## Validation Rules

Validation is handled with Laravel Form Requests and matching HTML input constraints.

### Customer validation

- `name`: required, trimmed, min 2, max 255
- `type`: required, must be `I` or `B`
- `email`: required, trimmed/lowercased, valid email, max 255, unique in `customers`
- `address`: required, trimmed, min 5, max 255
- `city`: required, trimmed, min 2, max 120
- `state`: required, trimmed, min 2, max 100
- `postal_code`: required, trimmed, min 3, max 20, pattern allows letters/numbers/space/hyphen only

### Invoice validation

- `customer_id`: required, integer, must exist in `customers`
- `amount`: required, integer, min 1, max 4294967295
- `status`: required, must be `B`, `P`, or `V`
- `billed_date`: required, valid date
- `paid_date`: nullable, valid date, must be greater than or equal to `billed_date`, and required when `status = P`

### Empty field behavior

- All required fields reject empty values.
- Text fields are trimmed before backend validation, so whitespace-only input is treated as empty.


## Database Schema

1. `customers`
	- `id`, `name`, `type (I/B)`, `email`, `address`, `city`, `state`, `postal_code`, `timestamps`
2. `invoices`
	- `id`, `customer_id` (FK to `customers.id`, cascade delete), `amount` (integer), `status (B/P/V)`, `billed_date`, `paid_date` nullable, `timestamps`
3. Default Laravel `users` table is kept.

## Windows + XAMPP Setup

1. Start `Apache` and `MySQL` in XAMPP Control Panel.
2. Create the MySQL database `testdb` (phpMyAdmin or CLI).
3. Ensure PHP 8.2+ and Composer are installed and available.
4. In project root, run the commands below.

## Exact Commands (Create + Run)

```powershell
composer create-project laravel/laravel:"^12.0" laravel-data-clone
cd laravel-data-clone
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
```

If `composer` or `php` are not in PATH on Windows, use full paths (example):

```powershell
C:\xampp\php\php.exe C:\path\to\composer.phar create-project laravel/laravel:"^12.0" laravel-data-clone
```

## Environment Template

`.env.example` is preconfigured for XAMPP MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=testdb
DB_USERNAME=root
DB_PASSWORD=
```

## URLs

- App root: `http://127.0.0.1:8000`
- Users: `http://127.0.0.1:8000/users`
- Customers: `http://127.0.0.1:8000/customers`
- Invoices: `http://127.0.0.1:8000/invoices`

## Notes

- Seeders generate 250 customers and 1-5 invoices per customer.
- `paid_date` is only stored when invoice status is `P` (Paid).
