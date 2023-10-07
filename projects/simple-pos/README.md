# Simple Pos

# Main Features

-   Product
-   Stock (In / Out)
-   Order
-   Report (Coming Soon)

# Installation

-   Clone this repo
<!-- - Change branch to `dev` -->
-   Run `composer install`
-   Import sql file in sql folder to your database
-   Copy `.env.example` to `.env`

# Configuration

-   Open `.env` and change the following lines:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_simplepos
DB_USERNAME=root
DB_PASSWORD=
```

# Usage

-   Run `php artisan key:generate`
-   Run `php artisan serve`
-   Open `http://localhost:8000` in your browser

# License

MIT License
