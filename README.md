# MedComact is a Medical Error Reporting Tool

## Overview

Medical Error Reporting Tool is a web application built with [Laravel](https://laravel.com/), a modern PHP framework. The project provides a robust platform for reporting, tracking, and analyzing medical errors, supporting authentication, user management, and rich data visualization.

<img width="1552" height="1572" alt="image" src="https://github.com/user-attachments/assets/c0453906-7a80-4be3-9a2d-cb89682b15b6" />


## Technologies Used

- **Backend Framework:** Laravel 8+
- **Frontend Framework:** Vue.js 3 (with [Inertia.js](https://inertiajs.com/) for SPA experience)
- **CSS Framework:** Tailwind CSS (with [@tailwindcss/forms](https://github.com/tailwindlabs/tailwindcss-forms) and [@tailwindcss/typography](https://github.com/tailwindlabs/tailwindcss-typography) plugins)
- **Build Tools:** Laravel Mix, Webpack
- **Database:** MySQL (default, configurable)
- **Authentication:** Laravel Jetstream & Fortify (with optional two-factor authentication)
- **API:** Laravel Sanctum (for SPA authentication)
- **Other:** ECharts for data visualization, Axios for HTTP requests, Lodash for utility functions

## Project Structure

- `app/` - Application logic (Controllers, Models, Providers, Actions)
- `resources/js/` - Vue.js components and SPA logic
- `resources/css/` - Tailwind CSS source
- `public/` - Compiled assets (JS, CSS), entry point (`index.php`)
- `config/` - Configuration files (database, cache, auth, etc.)
- `database/` - Migrations, seeders
- `routes/` - Route definitions
- `tests/` - PHPUnit tests

## Setup Instructions

1. **Clone the repository:**
   ```sh
   git clone <your-repo-url>
   cd Medical-Error-Reporting-Tool
   ```

2. **Install PHP dependencies:**
   ```sh
   composer install
   ```

3. **Install Node.js dependencies:**
   ```sh
   npm install
   ```

4. **Environment configuration:**
   - Copy `.env.example` to `.env`:
     ```sh
     cp .env.example .env
     ```
   - Edit `.env` and set your database credentials, mail settings, and other environment variables.

5. **Generate application key:**
   ```sh
   php artisan key:generate
   ```

6. **Run migrations:**
   ```sh
   php artisan migrate
   ```

7. **Build frontend assets:**
   ```sh
   npm run dev
   ```
   For production:
   ```sh
   npm run prod
   ```

8. **Serve the application:**
   ```sh
   php artisan serve
   ```
   The app will be available at [http://localhost:8000](http://localhost:8000).

## Deployment

- **Production Build:**  
  Run `npm run prod` to compile and version assets.
- **Web Server:**  
  Point your web server (Apache/Nginx) to the `public/` directory.
- **Storage Link:**  
  Create a symbolic link for storage:
  ```sh
  php artisan storage:link
  ```
- **Environment Variables:**  
  Set all required credentials in `.env` (see below).

## Credentials & Configuration

Edit `.env` with the following:

- **Database:**  
  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_db
  DB_USERNAME=your_user
  DB_PASSWORD=your_password
  ```

- **Mail:**  
  ```
  MAIL_MAILER=smtp
  MAIL_HOST=your_mail_host
  MAIL_PORT=your_mail_port
  MAIL_USERNAME=your_mail_user
  MAIL_PASSWORD=your_mail_password
  MAIL_ENCRYPTION=tls
  MAIL_FROM_ADDRESS=your@email.com
  MAIL_FROM_NAME="Medical Error Reporting Tool"
  ```

- **AWS (for S3 storage):**  
  ```
  AWS_ACCESS_KEY_ID=your_key
  AWS_SECRET_ACCESS_KEY=your_secret
  AWS_DEFAULT_REGION=us-east-1
  AWS_BUCKET=your_bucket
  ```

- **Other:**  
  Set `APP_URL`, `APP_KEY`, and other relevant variables.

## Testing

Run tests with:
```sh
phpunit
```
or
```sh
php artisan test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

For more details, see [README.md](README.md) and Laravel [documentation](https://laravel.com/docs).
