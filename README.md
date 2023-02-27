# Laravel User Signup Application


# Initial Setup
 1- Clone the project
 2- cp `.env.example` into `.env` and configure your env variables
 3- Run `composer install`
 4- Run `php artisan migrate` to run migrations project
 5- Run `php artisan serve` to start project
 5- Run `php artisan queue:work` to start the queue
 6- Import Postman Collection from `postman` folder to test the endpoints

 ### Alternatively ,
  you could the `./bin/start.sh` script that uses `docker-compose.yml` file but make sure to modify the `.env `variables accordingly 


 # Endpoints

 * `/api/register`  
 * `/api/login`  
 * `/api/email/verify/{id}/{hash}` this will be sent to the users in verification email once they register
 * `/email/verify/resend` this will resend the verification email to the logged in user one more time 
 * `/api/has_verified_email` this will return whether the logged in user is verified or not  