# Content Management System ![version-badge]
![Product Gif](demo.gif)

This repo for a Laravel (version 7.24) Content Management System web application.
It gives you the ability to add, edit, delete and view 
Posts that related to specific tag and category. 
The operation add, edit, delete and view is also available for tag and category.
The system have two roles admin and user.  

## Requirements
- HTTP Server. For example: Apache
- PHP 7
- MySQL
- Composer

Laragon will take care of that. you can download the full edition from [here](https://laragon.org/download/).

## Getting Started
1. Clone the repo to your device to a folder in C:\laragon\www
2. Create new database with cms name.
3. Create your .env file and past its content from .env.example then update the info related to connection with the database
    ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=cms
      DB_USERNAME=root
      DB_PASSWORD=
    ```
 4. To include the vendor folder just run the below command after cd into the Laravel project's directory.
    ```
      composer install
    ``` 
 5. run the command below to create the required tables
    ```
      php artisan migrate
    ```     
 5. Open Laragon and click start all to run Apache and MySQL. Run the project by click Menu-> www -> your project name or run the command below.
    ```
      php artisan serve
    ```

 Have fun :) 


 [version-badge]: https://img.shields.io/badge/version-1.0-blue.svg


