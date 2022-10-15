## About The Project

1. First you need to set .env and php 8.1 apache2 server for run this project
2. Inside the terminal run => composer install
3. Inside the terminal run => npm install && npm run dev ( npm run dev for react js compilation )
   Note : Please start your elastic search server and update the config host,port,username,password in config\elasticsearch.php file.
    - Also you need to add index inside elastic search before add entry inside elastic search. For that execute => php artisan elasticsearch:create-book-index
4. Inside the terminal run => php artisan db:seed --class=BooksSeeder ( for fake data insert inside the DB. Every time you will get 15000 records during seed)
   Note : You don't need to add entries inside elastic search index because during model entry creation time automatically entry is created inside elastic search also.
5. Inside the terminal run => php artisan serve ( for generate live url like => 127.0.0.1:8000 )
6. You can see on the home page there is books listing with functionality of search records of book and with pagination api call
7. Also for book full details you can click on Full Details button.
8. On the Header there are two Links
    1. User Listing => For local user or public view of book store URL => (http://127.0.0.1:8000/)
    2. Admin Listing => For Admin user add/update/delete/list records. URL => (http://127.0.0.1:8000/allListing)

Note : React Js code is inside of Component folder in resources directory.
