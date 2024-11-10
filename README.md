<p align="left">
<br>
    <a href="https://transcript.ao/">Website</a> |
    <a href="https://transcript.ao/docs/">Documentation</a> |
    <a href="https://transcript.ao/contact">Contact</a> |
    <a href="https://transcript.ao/features">Features</a> |
    <a href="https://www.discord.com/r/transcript/">Discord</a> |
</p>

# Transcript

Transcript is an all-in-one student evaluation system designed to streamline the process of managing academic assessments, exams, grades, and attendance. This versatile system is available on Android, iPhone, and the web, making it accessible to educators, students, and parents anytime, anywhere.

## Features:

Seamless Assessment Management: Easily create, distribute, and grade assessments and exams with user-friendly tools.

Comprehensive Grading: Automatically calculate and record students' grades and points, ensuring accurate and efficient grade management.

Attendance Tracking: Keep track of student attendance with real-time updates and notifications, helping to identify patterns and improve participation.

Cross-Platform Availability: Accessible on Android, iPhone, and the web, providing flexibility and convenience for all users.

User-Friendly Interface: Intuitive design makes it easy for educators to navigate and manage student information efficiently.

Secure Data Management: Ensure student data is kept safe with robust security measures and encryption.

### Why Choose Transcript?

Efficiency: Save time and reduce administrative workload with automated processes.

Accessibility: Access the system from any device, making it easy to stay connected and informed.

Reliability: Trust in a secure, reliable platform that supports the academic journey.



# For Developer


## Transcript Backend

This repository contains the backend code for the Transcript application, which is designed to handle student evaluations, assessments, grades, and attendance. The backend is built using the Laravel framework, enhanced with the Backpack package for administration. The database used is MySQL.

## Technologies Used
- **Laravel Framework**
- **Backpack Package**
- **MySQL**

## Getting Started

### Prerequisites
Make sure you have the following software installed on your local machine:
- mysql
- PHP >= 7.3
- Composer

### Installation
1. Clone the repository:
    ```bash
    git clone https://github.com/gabrielgits/transcriptweb.git
    cd transcriptweb
    ```

2. Copy the example environment file and configure the environment variables:
    ```bash
    cp .env.example .env
    ```

3. Generate key:
    ```bash
   php artisan key:generate
    ```

4. Install the dependencies using Composer:
    ```bash
    composer install
    ```
5. Run the database migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```
6. Run the database migrations and seeders:
    ```bash
    php artisan backpack:install
    ```
You can access the app in your browser now


## Docker Setup
The Docker setup includes services for the application, Nginx, MySQL, and phpMyAdmin.

This package provides `docker-compose.yml` to launch your database and web server easily

### Installation
1. Clone the repository:
    ```bash
    git clone https://github.com/gabrielgits/transcriptweb.git
    cd transcriptweb
    ```

2. Copy the example environment file and configure the environment variables:
    ```bash
    cp .env.example .env
    ```

3. Generate key:
    ```bash
   php artisan key:generate
    ```

4. Install the dependencies using Composer:
    ```bash
    composer install
    ```

5. Use these parameters in your .env file

```
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=dbtranscript
DB_USERNAME=usertranscript
DB_PASSWORD=passtranscript
```

6. Launch docker

```
docker-compose up -d
```

7. Connect container terminal

```
docker compose exec app bash
```

8. Migrate and seed

```
php artisan migrate --seed
```
9. Run the database migrations and seeders:
    ```bash
    php artisan backpack:install
    ```

You can access the app in your browser on

```
http://localhost:8000
```

and the Database in your browser on

```
http://localhost:8080
```

To stop the server simply run

```
docker-compose down
```


## Credits

- [Gabriel Vieira][https://github.com/gabrielgits]


## Hire us

If you are looking for a developer/team to help you build a system, look no further. You'll have a difficult time finding someone with more experience & enthusiasm for this. This is _what we do_. [gabrielvieira@outlook.com](gabrielvieira@outlook.com).
