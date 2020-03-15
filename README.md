# Laravel Micro

## Instrucciones de instalación

1. Instalar [composer](https://getcomposer.org/Composer-Setup.exe)
2. Instalar Laravel con ```composer global require "laravel/installer"``` en el terminal
3. Instalar [XAMPP](https://www.apachefriends.org/xampp-files/7.3.6/xampp-windows-x64-7.3.6-3-VC15-installer.exe)
4. Escribir en terminal ```git clone https://github.com/Discretuum/laravel-micro.git```
5. ```cd laravel-micro```
6. ```composer install```
7. ```php artisan serve```

## Cargar base de datos

1. Ir al root del proyecto y abrir el terminal
2. Limpiar la configuración con ```php artisan config:clear```
3. Crear la tabla migraciones con ```php artisan migrate:install```
4. Crear las tablas que están en las migraciones con ```php artisan migrate:refresh```
5. Cargar datos de prueba con ```php artisan db:seed```
