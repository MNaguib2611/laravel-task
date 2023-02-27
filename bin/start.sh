

# 1- stop the project in case of running
docker-compose down 


# 2- build and run the project
docker-compose up --build


# 3- run the project migration
docker-compose exec app php artisan migrate:fresh --seed


# 4- start the queue 
docker-compose exec app php artisan queue:work 