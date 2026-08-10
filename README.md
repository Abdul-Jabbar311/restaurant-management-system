# 🍽️ Restaurant Management System

A full-stack **Restaurant Management System** developed using **Laravel, PHP, MySQL, Blade, HTML, CSS, and JavaScript**. The system provides a centralized platform for managing restaurant operations, including customers, menu items, orders, reservations, and other administrative activities.

## 🌐 Live Demo

**Live Website:**
https://restaurantmanagement.rf.gd

> Note: The live demo is hosted on InfinityFree for demonstration and educational purposes.

---

## 📌 Project Overview

The Restaurant Management System is designed to simplify common restaurant management tasks through a web-based application.

Instead of managing restaurant information manually, administrators can use the system to manage important data through a structured dashboard and database.

The project demonstrates practical use of **Laravel MVC architecture, CRUD operations, MySQL database management, authentication, routing, migrations, controllers, models, Blade templates, and form handling**.

---

## ✨ Features

### 👤 Customer Management

* Add customers
* View customer information
* Update customer records
* Delete customer records
* Store customer contact information

### 🍽️ Menu Management

* Add menu items
* Update menu items
* Delete menu items
* Manage menu information
* Organize restaurant items

### 🧾 Order Management

* Create and manage orders
* Manage order information
* Track order records
* Store order details in MySQL

### 📅 Reservation Management

* Create reservations
* View reservation records
* Update reservation information
* Manage customer reservations

### 🔐 Authentication

* User authentication
* Login/logout functionality
* Protected management pages

### 📊 Database Management

* MySQL relational database
* Laravel migrations
* Eloquent ORM
* CRUD operations
* Database relationships

---

## 🛠️ Technologies Used

| Technology      | Purpose                   |
| --------------- | ------------------------- |
| PHP             | Backend programming       |
| Laravel         | Web application framework |
| MySQL           | Database                  |
| Blade           | Laravel templating engine |
| HTML5           | Page structure            |
| CSS3            | Styling                   |
| JavaScript      | Client-side functionality |
| Bootstrap / CSS | Responsive UI             |
| Git             | Version control           |
| GitHub          | Source code management    |
| InfinityFree    | Deployment                |

---

## 🏗️ Architecture

The project follows the **MVC (Model-View-Controller)** architecture provided by Laravel.

```text
User
  ↓
Routes
  ↓
Controller
  ↓
Model / Eloquent
  ↓
MySQL Database
  ↓
Controller
  ↓
Blade View
  ↓
User
```

### Models

Models are responsible for interacting with the database using Laravel's Eloquent ORM.

### Controllers

Controllers handle application logic, process requests, validate data, and communicate with models.

### Views

Blade templates are used to display the application's user interface.

### Routes

Laravel routes define how requests are handled and which controllers are executed.

---

## 🗄️ Database

The system uses **MySQL** as its relational database.

The database contains tables for managing different parts of the restaurant system, such as:

* Customers
* Menu Items
* Orders
* Reservations
* Users

Laravel migrations are used to create and manage database structures.

---

## 📂 Project Structure

```text
restaurant-management-system/
│
├── app/
│   ├── Http/
│   ├── Models/
│   └── Providers/
│
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
├── resources/
│   └── views/
│
├── routes/
│   └── web.php
│
├── storage/
├── tests/
│
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/YOUR-USERNAME/YOUR-REPOSITORY.git
```

### 2. Navigate to the project

```bash
cd restaurant-management-system
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Create environment file

```bash
cp .env.example .env
```

On Windows, you can also create a copy of `.env.example` and rename it to `.env`.

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Configure database

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Start the development server

```bash
php artisan serve
```

The application will normally be available at:

```text
http://127.0.0.1:8000
```

---

## 🚀 Deployment

The project is currently deployed online using **InfinityFree**.

### Live Application

https://restaurantmanagement.rf.gd

For production deployment, configure:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

and configure the production MySQL database credentials in `.env`.

---

## 🔒 Security

Sensitive environment information should **not** be committed to GitHub.

The `.env` file should remain excluded through `.gitignore`.

Example:

```text
.env
/vendor/
/node_modules/
```

Never upload production database passwords or application secrets to a public repository.

---

## 🎯 Learning Objectives

This project was developed to gain practical experience with:

* Laravel framework
* PHP backend development
* MVC architecture
* MySQL database design
* Eloquent ORM
* CRUD operations
* Authentication
* Laravel routing
* Blade templates
* Form validation
* Database migrations
* Git and GitHub
* Web deployment

---

## 🔮 Future Improvements

Possible future enhancements include:

* Online payment integration
* Restaurant analytics dashboard
* Sales reports
* Inventory management
* Role-based access control
* Email notifications
* SMS notifications
* Advanced order tracking
* Table management
* Staff management
* API integration
* Mobile application

---

## 👨‍💻 Developer

**Abdul Jabbar**

Bachelor of Computer Science
Capital University of Science and Technology (CUST)

---

## 📄 License

This project was developed for educational and portfolio purposes.
