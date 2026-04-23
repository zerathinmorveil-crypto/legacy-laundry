composer require laravel/breeze --dev
php artisan breeze:install
composer require jeroennoten/laravel-adminlte
php artisan adminlte:install
composer require barryvdh/laravel-dompdf

php artisan make:mode Customer -mcr
php artisan make:mode Service -mcr
php artisan make:mode Member -mcr
php artisan make:mode Transaction -mcr

php artisan make:controller Customer/OrderController
php artisan make:controller Customer/HomeController
php artisan make:controller UserController

php artisan make:middleware RoleMiddleware 
php artisan make:controller DashboardController
php artisan make:migration update_status_enum_on_transactions_table --table=transactions
php artisan make:migration add_order_columns_to_transactions_table --table=transactions 
php artisan make:migration add_role_to_users_table --table=users

php artisan make:seeder AdminSeeder
php artisan db:seed --class=AdminSeeder
php artisan make:seeder ServiceSeeder
php artisan db:seed --class=ServiceSeeder 

file yg di bk:
RegisteredUserController
app
seeders admin, database, service
resource/views/customer/order
