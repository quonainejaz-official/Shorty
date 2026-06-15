<p align="center">
    <div align="center">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </div>
</p>

# Shorty - URL Shortener

Shorty is a Laravel-based URL shortening application that allows users to create shortened links, track clicks, and manage their links from a dashboard.

## Features

- User authentication (register, login, logout)
- Password reset via OTP email verification
- URL shortening with custom short codes
- Click tracking for each shortened link
- Dashboard with stats (total links, total clicks, most active link)
- Responsive UI built with Tailwind CSS

## Requirements

- PHP ^8.4
- Composer
- Node.js & NPM
- MySQL or PostgreSQL

## Installation

```bash
# Clone the repository
git clone https://github.com/quonainejaz-official/Shorty.git
cd Shorty

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Build frontend assets
npm run build

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Configure your database in .env file
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=shorty
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# (Optional) Seed database
php artisan db:seed

# Start development server
php artisan serve
```

## Usage

1. Register a new account or login
2. From the dashboard, enter a URL to shorten
3. Optionally provide a custom short code
4. Click "Shorten Now" to generate your shortened link
5. Share your short URL with others
6. Track clicks from the dashboard

## API

The application also provides a JSON API for all endpoints. Send requests with `Accept: application/json` header or use `/api/*` routes.

### Register

```bash
POST /register/submit
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

### Login

```bash
POST /login/submit
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password"
}
```

### Create Short Link

```bash
POST /shorten
Authorization: Bearer {token}
Content-Type: application/json

{
    "destination_url": "https://example.com/very-long-url",
    "custom_id": "my-link"
}
```

## Deployment

### Railway

1. Push to GitHub
2. Create a new project on Railway from your GitHub repo
3. Add a PostgreSQL database
4. Set environment variables:
   - `APP_KEY` (generate with `php artisan key:generate --show`)
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `DB_CONNECTION=pgsql`
   - `DB_URL=${{Postgres.DATABASE_URL}}`
   - `SESSION_DRIVER=database`
   - `CACHE_STORE=database`
5. Build command: `composer install --no-dev && php artisan optimize`
6. Start command: `php artisan serve --host=0.0.0.0 --port=$PORT`

### Render

1. Push to GitHub
2. Create a new Web Service on Render from your GitHub repo
3. Add a PostgreSQL database
4. Set the same environment variables as above
5. Build command: `composer install --no-dev && php artisan optimize`
6. Start command: `php artisan serve --host=0.0.0.0 --port=$PORT`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
