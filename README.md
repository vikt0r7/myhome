Command to build:

cd myhome/
composer install
php artisan sail:install
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail up -d
sail shell
php artisan cms:install


sail down --rmi all -v
sail down -v
sail build --no-cache
sail up -d
