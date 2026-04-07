# laravel-data-clone

Laravel 12 + MySQL CRUD project that replicates the SQL_CRUD lab functionality from `Laravel_data-main`.

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
