# CryptoInvestment Dashboard

## Stack

- Laravel
- SQLite
- Chart.js
- TailwindCSS

## Features

- Real-time cryptocurrency tracking
- Historical price storage
- Automatic price updates via Laravel Scheduler
- Interactive chart visualization

## Setup

1. Install dependencies

composer install

2. Configure environment

cp .env.example .env
php artisan key:generate

3. Run migrations

php artisan migrate

4. Start scheduler

php artisan schedule:work

5. Start server

php artisan serve