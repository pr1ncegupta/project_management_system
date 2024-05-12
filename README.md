# Student Management System

Welcome to the Student Management System project! This system helps manage student projects, marks, attendance, and more.

## Features

- **Login System:** Users can log in based on their roles (admin, guide, student).
- **Dashboard:** Different dashboards for admin, guide, and student users.
- **Project Management:** Students can submit project links, and guides can review and add remarks/ratings.

## Installation

### Prerequisites

- Web server software (e.g., XAMPP)
- PHP version 7.x
- MySQL database

### Setup

1. Clone this repository

2. Import the database:
- Navigate to the `db.md` directory.
- Copy all and paste it into your xampp mysql

3. Configure database connection:
- Update `db_connection.php` with your database credentials:
  ```php
  $servername = "localhost";
  $username = "your_username";
  $password = "your_password";
  $dbname = "student_management_system";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  ```

## Usage

1. Start your local web server.
2. Navigate to the project directory in your web browser.
3. Log in using the provided credentials for admin, guide, or student.

## Adding Users and Assigning Group IDs

### Admin Actions

1. Log in as an admin.
2. Navigate to "Manage Users" to view existing users.

### Guide Actions

1. Log in as a guide.
2. Use the system to assign group IDs to students.

### Student Actions

1. Log in as a student.
2. View assigned group IDs and submit project links.

## Project Management

### Submitting Project Links

1. Log in as a student.
2. Navigate to "Submit Progress" to submit project links.
3. Provide the project ID and project link.

### Viewing Project Links

1. Log in as a guide.
2. Navigate to "See Group Weekly Progress" to view submitted project links.
3. Add remarks or ratings based on the project submissions.

## Contributing

Contributions are welcome! Here's how you can contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/new-feature`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add new feature'`).
5. Push to the branch (`git push origin feature/new-feature`).
6. Create a new Pull Request.

## Manual User Addition
Currently it supports only manual user addition
For user management, manually add users directly to the MySQL database using a tool like phpMyAdmin in XAMPP.

## Collaborators

- [RahulRmCoder](https://github.com/RahulRmCoder)
- [SakshiThakur410](https://github.com/SakshiThakur410)
- [siddhi-rungta](https://github.com/siddhi-rungta)


## License

This project is licensed under the [MIT License](LICENSE).
