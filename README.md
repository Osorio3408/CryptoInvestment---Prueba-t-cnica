# CryptoInvestment Dashboard

## Overview

CryptoInvestment Dashboard is a simple web application that allows
investors to track the performance of cryptocurrencies in real time.

The system retrieves cryptocurrency data from the CoinMarketCap API,
stores historical price information, and displays interactive charts for
trend analysis.

The application was designed as a **single-page dashboard** with dynamic
updates, allowing users to monitor market behavior without page reloads.

------------------------------------------------------------------------

# Stack

-   Laravel
-   SQLite
-   Chart.js
-   TailwindCSS
-   JavaScript (Fetch API)

------------------------------------------------------------------------

# Functional Requirements

The system provides the following functionality:

-   Display a list of tracked cryptocurrencies
-   Show the **current price** of each cryptocurrency
-   Show the **24-hour percentage change**
-   Persist **historical price data**
-   Allow visualization of **price history through charts**
-   Update cryptocurrency prices automatically
-   Retrieve cryptocurrency data from an external API (CoinMarketCap)
-   Provide dynamic updates without reloading the page
-   Allow users to select a cryptocurrency to view its historical
    performance

------------------------------------------------------------------------

# Non-Functional Requirements

The system was designed considering the following quality attributes:

### Performance

-   Cryptocurrency data is cached and updated periodically to reduce API
    calls.

### Scalability

-   The architecture allows easy extension to support more
    cryptocurrencies or additional metrics.

### Usability

-   The interface is a **single-page dashboard** designed for quick
    visualization and interaction.

### Maintainability

-   The application follows Laravel best practices using:
    -   Controllers
    -   Models
    -   Resources
    -   Artisan Commands

### Responsiveness

-   The UI uses TailwindCSS to ensure compatibility with multiple screen
    sizes and devices.

------------------------------------------------------------------------

# Features

-   Real-time cryptocurrency tracking
-   Historical price storage
-   Automatic price updates via Laravel Scheduler
-   Interactive chart visualization

------------------------------------------------------------------------

# Setup

## 1. Install dependencies

composer install

## 2. Configure environment

cp .env.example .env\
php artisan key:generate

## 3. Run migrations

php artisan migrate

## 4. Start scheduler

php artisan schedule:work

## 5. Start server

php artisan serve

------------------------------------------------------------------------

# API Endpoints

## Get cryptocurrencies

GET /api/cryptos

Returns a list of tracked cryptocurrencies with price and percentage
change.

------------------------------------------------------------------------

## Get price history

GET /api/cryptos/{symbol}/history

Returns the historical price data used for chart visualization.

------------------------------------------------------------------------

# Author

Yuliam Osorio
