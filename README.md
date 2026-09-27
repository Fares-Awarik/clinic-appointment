# Clinic Appointment System

A Laravel learning project for clinic record management. It brings together doctors, patients, and appointments in one application and gives me a place to practice PHP, database design, and Laravel's MVC structure.

## Project overview

- Doctor and patient records are organized with Laravel models, controllers, Blade views, and migrations.
- Laravel Breeze provides authentication; Spatie Laravel Permission is used for roles and permissions.
- Form validation, Eloquent queries, search, and pagination are demonstrated in the record management code.
- Appointments have their own model, migration, controller, and form.

## Code to review

- [`DoctorController.php`](app/Http/Controllers/DoctorController.php): input validation, Eloquent CRUD, search, and pagination.
- [`PatientController.php`](app/Http/Controllers/PatientController.php) and [`app/Http/Requests/`](app/Http/Requests/): patient CRUD and dedicated validation requests.
- [`routes/web.php`](routes/web.php): authenticated resource routes and deletion permissions.
- [`database/migrations/`](database/migrations/): database schema for doctors, patients, and appointments.

## Run locally

Requirements: PHP 8.2+, Composer, Node.js/npm, and SQLite with the PHP SQLite extension.

```bash
git clone https://github.com/Fares-Awarik/clinic-appointment.git
cd clinic-appointment
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
php artisan db:seed --class=RolesSeeder
npm install
npm run build
php artisan serve
```

The example environment uses SQLite. Open the local URL shown by `php artisan serve`, register an account, and sign in. To use another database, change the `DB_*` values in `.env` before running migrations.

## Stack

PHP, Laravel 12, Blade, Eloquent ORM, Laravel Breeze, Spatie Laravel Permission, SQLite for local setup, and Vite/Tailwind CSS for assets.
