# Laravel User Signup Application


# Initial Setup
 1- Clone the project
 2- create `hitech` & `hitech_testing` databases in mysql 
 3- cp `.env.example` into `.env` and configure your env variables
 4- Use `mailtrap` to get credentials for a test inbox and use them in .env 
 5- Run `composer install`
 6- Run `php artisan migrate` to run migrations project
 7- Run `php artisan serve` to start project
 8- Run `php artisan queue:work` to start the queue
 9- Import Postman Collection from `postman` folder to test the endpoints

PS: the `.env.example` is prefilled with env variables for convenience only
 ### Alternatively ,
  you could the `./bin/start.sh` script that uses `docker-compose.yml` file but make sure to modify the `.env `variables accordingly 


 ## Endpoints

 * `/api/register`  
 * `/api/login`  
 * `/api/email/verify/{id}/{hash}` this will be sent to the users in verification email once they register
 * `/email/verify/resend` this will resend the verification email to the logged in user one more time 
 * `/api/has_verified_email` this will return whether the logged in user is verified or not  




## Testing 
simply run `php artisan test to run all test cases`
### Note
All tests were done as feature test as `unit test` is not supposed to connect to database or hit endpoints 

### As per requirements unit tests:

1- Test that a new user can be created and saved to the database. 
2- Test that validation rules on the signup form work as expected.
3- Test that the queue job is dispatched when a new user is created.
4- Test that the verification email is sent to the user's email address.

### As per requirements feature tests:
1-Test that a user can successfully sign up and receive a verification email.
2-Test that an error is displayed when validation rules on the signup form are not met.
3-Test that the user can successfully verify their email address.

## The following is a description of all feature tests created
### `test_failed_validation_register_user_missing_attributes`
- Test that validation rules on the signup form work as expected.
- Test that an error is displayed when validation rules on the signup form are not met.

### `test_successful_register_passed_validation`
- Test that validation rules on the signup form work as expected.
- Test that a new user can be created and saved to the database. 

###` test_verify_email_is_sent_upon_registration`
- Test that the queue job is dispatched when a new user is created.

### `test_user_can_verify_email`
-Test that the user can successfully verify their email address.


## for manual testing
* use postman Collection
* check the records in database jobs & failed jobs
* confirm that `register` & `resend` endpoint execute without without waiting for the email
