# mkdir dist
composer install
open http://localhost:8000
php -S localhost:8000 -t app/
# php -S 0.0.0.0:8000 -t app/