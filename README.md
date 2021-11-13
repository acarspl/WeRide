## About WeRide

WeRide is a tech demo (early prototype version) of a CRUD web application built in Laravel framework
which allows users to create, modify, browse and participate in cycling events.  

## Technology
Backend:
- PHP 8
- Laravel 8
- PHPUnit    

Frontend:
- HTML5
- CSS3
- Bootstrap 4
- Javascript + jQuery
- Leaflet


## How to run it

Create a database locally named weride utf8_general_ci

Rename .env.example file to .env inside the project root and fill the database information

Run the following commands:   

`composer install`    
`npm install && npm run dev`  
`php artisan key:generate`  
`php artisan migrate`  
`php artisan db:seed`  
`php artisan serve`  

## Author
Created by: Adam Szczepkowski (UTH 27781)

