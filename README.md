<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This project is an ERP-based website, which has features (incoming/outgoing mail, account code transaction management, and member management)

Role in project only one : admin

## Getting Started

To use **ERP Koperasi**, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/Luthfi-pratama/erp-kop.git

2. Setting the .env
   
   ```bash
   adjust it to your database name

3. if you haven't installed composer and npm

   ```bash
   comnposer install
   npm install

4. Then, make the key generate laravel

   ```bash
   php artisan key:generate

5. Migration database

   ```bash
   php artisan migrate

6. do dummy data because I have set the role in the database

   ```bash
   php artisan db:seed

7. FOR RUN WEBSITE

   ```bash
   php artisan serve

8. Username And password

   ```bash
   username : admin
   password : admin123
   
   
