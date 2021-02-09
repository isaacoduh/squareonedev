## Square One Task

## To Setup Project

-   download project
-   run cp .env.example ,env
-   run migration and db:seed
-   run php artisan schedule:work to start the external data retrieval

## Key Points to Note

-   caching is set to 60 seconds
-   authentication details are set in user table seeders
-   Controllers: BlogController, PostController
-   Routing is taken care of in web.php
-   Command RetriveData::class is setup in Console/Commands/RetrieveData and is add to the Console/Kernel.
