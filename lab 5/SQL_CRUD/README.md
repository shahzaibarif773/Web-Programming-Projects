## PHP CRUD Example

Simple PHP CRUD application built with **PHP (mysqli)**, **MySQL**, and **XAMPP**. It lets you add, list, edit, and delete users from a `users` table.

## Project Structure

- `php/index.php` – main page (add user form + user list)
- `php/update.php` – edit user page
- `php/delete.php` – delete user handler
- `php/insert.php` – insert user handler
- `php/db.php` – database connection (`testdb` database, `users` table)
- `php/seed_users.php` – optional script to insert sample users
- `css/style.css` – UI styling

## Database

- **Host**: `localhost`
- **User**: `root`
- **Password**: (empty)
- **Database**: `testdb`
- **Table**: `users`
  - `id` INT AUTO_INCREMENT PRIMARY KEY
  - `name` VARCHAR(100)
  - `email` VARCHAR(100)
  - `password` VARCHAR(255)

## How to Run

1. Start **Apache** and **MySQL** in XAMPP.
2. Import/create the `testdb` database and `users` table as above.
3. Place this project in `C:\xampp\htdocs\SQL_CRUD`.
4. Open in browser:
   - Main app: `http://localhost/SQL_CRUD/php/index.php`
   - (Optional) Seed users: `http://localhost/SQL_CRUD/php/seed_users.php` (run once).

## Tutorial Video

You can watch the full tutorial here:  
[PHP CRUD Example Tutorial (Google Drive)](https://drive.google.com/file/d/1N2sedY5-UQJQYAay6patmoKyflXBCbJt/view?usp=sharing)

