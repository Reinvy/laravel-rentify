# Laravel Project Documentation

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Running the Project](#running-the-project)
-   [Testing](#testing)
-   [Contribution Guidelines](#contribution-guidelines)

## Requirements

Ensure you have the following installed:

-   PHP >= 8.2
-   Composer
-   MySQL or any other database supported by Laravel

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/Reinvy/laravel-rentify.git
    cd laravel-rentify
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install
    ```

4. Generate an application key:
    ```bash
    php artisan key:generate
    ```

## Configuration

1. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Set your environment variables in the `.env` file. Here are some important configurations:

    - **APP_URL**: Your application URL, e.g., `http://localhost`
    - **DB_CONNECTION**: Your database driver (default is `mysql`)
    - **DB_HOST**: Database host (default is `127.0.0.1`)
    - **DB_PORT**: Database port (default is `3306`)
    - **DB_DATABASE**: Database name
    - **DB_USERNAME**: Your database username
    - **DB_PASSWORD**: Your database password

3. Migrate the database:

    ```bash
    php artisan migrate
    ```

4. Buat akun admin dengan Filament:

    Untuk membuat akun admin yang dapat digunakan untuk mengakses dashboard Filament, jalankan perintah berikut di terminal:

    ```bash
    php artisan make:filament-user
    ```

    Ikuti instruksi di terminal untuk mengisi detail akun admin, seperti:

    - **Name**: Nama lengkap admin.
    - **Email**: Email yang akan digunakan untuk login.
    - **Password**: Kata sandi untuk akun admin.

    Setelah selesai, akun admin berhasil dibuat dan dapat digunakan untuk login ke dashboard Filament.

## Running the Project

To start the development server, run:

```bash
php artisan serve
```

Open your browser and visit: [http://localhost:8000](http://localhost:8000)

## Testing

To run the test suite, use:

```bash
php artisan test
```

Make sure that all tests pass before submitting any code changes.

## Contribution Guidelines

We welcome contributions! Follow these steps to contribute:

1. **Fork the repository**  
   Navigate to the repository on GitHub and click the "Fork" button.

2. **Clone the forked repository**

    ```bash
    git clone https://github.com/Reinvy/laravel-rentify.git
    cd laravel-rentify
    ```

3. **Create a new branch**  
   Create a new branch for your feature or bugfix:

    ```bash
    git checkout -b feature/your-feature-name
    ```

4. **Make your changes**  
   Add your features or fix bugs in this branch. Follow best coding practices and write tests if needed.

5. **Commit your changes**  
   After making changes, commit them with a clear and concise message:

    ```bash
    git add .
    git commit -m "Add feature X"
    ```

6. **Push to your branch**  
   Push your changes to your forked repository:

    ```bash
    git push origin feature/your-feature-name
    ```

7. **Submit a Pull Request**  
   On GitHub, go to the original repository and submit a pull request. Provide a detailed description of your changes.

### Code Style Guidelines

-   Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards.
-   Ensure all new features have corresponding tests.
-   Ensure your code is linted before committing.

---

Thank you for contributing!
