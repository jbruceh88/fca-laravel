## READ ME

This project is a work in progress as the development set up is finalised. 
At the moment docker is used to set up an ubuntu server, running php8, Laravel 8 and MySQL 5.7 . Mysq is to be updated to Mysql 8 in due course. 
All updates to this set up are to be tested and committed into this repo. The readme file must also be kept up to date. 

Currently the project uses Apache.


## Basic Setup
Clone the project and run the following and cd into the project folder. 
Copy and update the .env file as needed:
``` cp .env.example .env```
Now you can run the following docker commands:
``` docker-compose build && docker-compose up -d && docker-compose logs -f```
In a new terminal navigate back to the project and run:
``` docker exec -it laravel-app bash -c "sudo -u devuser /bin/bash"```
This will allow you to access the new server created 
The following will need to be ran on the server:
``` 
composer install
php artisan key:generate
php artisan migrate
php artisan ui vue --auth
```

You now need to update your host file to include the following
``` 127.0.0.1       <app_name.local>```

## Useful commands
If things do not look right i.e. no css run the following:
```
php artisan route:clear
php artisan cache:clear
php artisan view:clear
npm run dev
```
