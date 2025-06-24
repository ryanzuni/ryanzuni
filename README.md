<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <b>User & Task Management API</b><br>
  RESTful API project built with Laravel 10 and Vanilla JS as part of Fullstack Developer test.
</p>

---

## 🧩 Fitur Utama

- Autentikasi token menggunakan Laravel Sanctum
- Role-based access control (admin, manager, staff)
- CRUD task dan user
- Activity log
- Scheduler: task overdue checker
- Dashboard HTML + Vanilla JS (tanpa framework frontend)

---

## 🚀 Instalasi

```bash
git clone https://github.com/ryanzuni/repo.git
cd repo
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

| Role    | View Users | Manage Tasks | Assign Tasks | View Logs |
| ------- | ---------- | ------------ | ------------ | --------- |
| Admin   | ✅          | ✅            | ✅            | ✅         |
| Manager | ✅          | ✅ (team)     | ✅ (staff)    | ❌         |
| Staff   | ❌          | ✅ (self)     | ❌            | ❌         |

