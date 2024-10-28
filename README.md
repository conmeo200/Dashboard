- CMD: composer install
- CMD: cp .env.example .env
    + Change config DB
- CMD: php artisan key:generate
- CMD: composer require laravel/sanctum
- CMD: php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
- CMD: php artisan migrate
- CMD: php artisan db:seed
- CMD: npm install
- CMD: npm install vue 
- CMD: npm install vue-router
- CMD: npm install vue-bootstrap 

# Run Install Extension
B1 : chmod +x install-extensions.sh // check folder
B2 : ./install-extensions.sh //handle 

