# 🛍️ Simple Laravel Store Project

A lightweight Laravel Blade-based web application built during my role as a web development trainer at the **ISCEIT Center**. This project demonstrates foundational CRUD operations and user authentication with role-based access using middleware.

---

## 📌 Project Overview

This project is a basic store management system built with **Laravel**, focusing on:

- CRUD operations for **Products** and **Categories**
- A simple **Dashboard** for admin users
- User authentication with **role-based middleware**
- A **shopping cart** feature for users
- **Invoice/Bill printing** after checkout

---

## ✨ Features

### 🛒 User Side
- User Registration & Login
- View product list (by category)
- Add products to cart
- View and print purchase bill

### ⚙️ Admin Side
- Admin login with dashboard access (via middleware)
- Add/Edit/Delete **Products**
- Add/Edit/Delete **Categories**
- Manage users (basic add/delete)
- Full control of CRUD operations from dashboard

### 🔐 Middleware
- `admin` middleware: Restricts dashboard access to admins only
- `auth` middleware: Ensures only logged-in users can access the cart and perform checkout

---

## 🛠️ Technologies Used

- **Laravel** (v9 or v10)
- **Blade** templating engine
- **PHP 8+**
- **MySQL**
- **Bootstrap** for styling (optional)
- **Laravel Authentication** (Breeze/Jetstream/Auth scaffolding)

---

## 🚀 Setup Instructions

1. Clone the repository:

```bash
-git clone https://github.com/fatemah28/myStore.git
-cd myStore
-composer install
-cp .env.example .env
-php artisan key:generate
-php artisan migrate --seed
-php artisan serve



