# CMS

## Installation steps

1. CREATE DATABASE cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
1. Run command in the CLI: `git clone http://github.com/VladimirSavitchi/laravel8-cms.git`
1. cd laravel8-cms/
1. cp .env.example .env
1. composer install 
1. npm install
1. php artisan migrate
1. php artisan db:seed
1. php artisan storage:link
1. php artisan serve

npm run dev //webpack css and js
npm run prod //also minimizes them

## Access

1. Goto http://127.0.0.1:8000.
1. Type in the username 'admin@admin.com' and password 'password'.


## Clear Cache
1. php artisan cache:clear && 
1. php artisan config:cache && 
1. php artisan view:clear && 
1. php artisan route:cache