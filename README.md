# Event Management System

## Overview
The Event Management System is a web-based application built with PHP, MySQL, and Bootstrap. It allows users to register, log in, and manage events by creating, editing, and deleting them.

## Features
- User Registration
- User Login & Authentication
- Create New Events
- Edit Existing Events
- Delete Events
- Secure Password Hashing
- Responsive Design with Bootstrap

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/event-management.git
   ```
2. Navigate to the project directory:
   ```bash
   cd event-management
   ```
3. Set up the database:
   - Create a MySQL database named `event_management`.
   - Import the `database.sql` file provided in the project.
   
4. Configure the database connection in `config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'event');
   ```
5. Start the PHP development server:
   ```bash
   php -S localhost:8000
   ```
6. Open `http://localhost:8000` in your browser.

## Usage
### Register a User
1. Visit the registration page (`register.php`).
2. Fill in the required details.
3. Submit the form to create an account.

### Login
1. Go to the login page (`login.php`).
2. Enter your email and password.
3. Click Login to access your dashboard.

**Default Admin Credentials:**
- **Username:** admin
- **Password:** 123

### Manage Events
- **Create Event**: Click on "Create Event", fill in details, and submit.
- **Edit Event**: Click the edit button next to an event, update details, and save.
- **Delete Event**: Click the delete button next to an event to remove it.

## Technologies Used
- PHP
- MySQL
- Bootstrap
- HTML/CSS

## License
This project is licensed under the MIT License.

## Author
Mehfuz Ahmed

