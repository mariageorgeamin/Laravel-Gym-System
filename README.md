# Laravel-Gym-System
A system to organize and facilitate the process of member's subscription, assigning managerial roles.
## Built With
- Laravel 5.8
## Installation
- clone this repository to your local machine
- open your terminal inside the repository and type
    ```bash
    composer install
    ```
    this will install the required dependencies to run this project

- Then copy the contents of [.env.example](https://github.com/nourkilany/gym-management-system/blob/master/.env.example) and create a file named .env and paste those contents then edit them with your environment variables

- Create a database with a name of your choice (Don't forget to add it in the env file) then you can make the migration and seed the database with dummy data through writing this command inside your repository terminal

    ```bash
    php artisan migrate --seed
    ```
    Additionally it will also create an admin account with email: admin@iti.com and password:admin (You can change it)
