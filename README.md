# Real Estate Site

## Prerequisites

- php 8.2
- node.js 20

## Installation

1.In your terminal run composer install

2.Copy `.env.example` to `.env` and updated the configurations (mainly the database configuration)

3.In your terminal run `php artisan key:generate`

4.Run `php artisan migrate --seed` to create the database tables and seed the roles and users tables

5.Run `php artisan storage:link` to create the storage symlink (if you are using Vagrant with Homestead for development, remember to ssh into your virtual machine and run the command from there).
