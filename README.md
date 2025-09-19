# Laravel Simple Book CRUD Application

This is a simple Laravel web application that implements full CRUD (Create, Read, Update, Delete) operations to manage a list of books.

## Features

- Add new books with title, author, and published year.
- View a list of all books.
- Edit details of existing books.
- Delete books from the list.
- (Optional) Search/filter books by title or author.
- (Optional) Authentication using Laravel Breeze or Jetstream.

## Requirements

- PHP >= 8.x
- Composer
- MySQL or PostgreSQL database
- Laravel 10.x (or your version)
- Node.js & npm (for frontend assets)

## Installation

1. Clone the repository:
git clone https://github.com/aniketyadav197/Laravel-Simple-Book-Crud.git
cd Laravel-Simple-Book-Crud

2. Install PHP dependencies:
composer install

3. Update your environment variables:
Edit the .env file and update the database credentials and other configurations as needed, for example:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

4. Run the database migrations to create tables:
php artisan migrate

5. Seed the database with sample data
php artisan db:seed

6. Start the development server:
php artisan serve

7.Open your browser and navigate to:
http://localhost:8000


## Usage

The main page lists all books with their title and author.

Use the "Add New Book" form to create a new book entry.

Click on a book to edit its details or delete it.

(If implemented) Use the search bar to filter books by title or author.

## Deployment

This app can be deployed on any server supporting PHP and Laravel, such as Heroku, DigitalOcean, or AWS.

## License

This project is open-sourced under the MIT License.

Author: Aniket Yadav
GitHub: aniketyadav197