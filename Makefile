composer:
	cp ../common/.env .env
	composer install
st:
	mkdir -p vendor/laravel/ui/auth-backend/backup
	mv vendor/laravel/ui/auth-backend/AuthenticatesUsers.php vendor/laravel/ui/auth-backend/backup/
	mv vendor/laravel/ui/auth-backend/RegistersUsers.php vendor/laravel/ui/auth-backend/backup/
	mv vendor/laravel/ui/auth-backend/ResetsPasswords.php vendor/laravel/ui/auth-backend/backup/
	mv vendor/laravel/ui/auth-backend/SendsPasswordResetEmails.php vendor/laravel/ui/auth-backend/backup/
	cp ../common/vendor/AuthenticatesUsers.php vendor/laravel/ui/auth-backend/
	cp ../common/vendor/RegistersUsers.php vendor/laravel/ui/auth-backend/
	cp ../common/vendor/ResetsPasswords.php vendor/laravel/ui/auth-backend/
	cp ../common/vendor/SendsPasswordResetEmails.php vendor/laravel/ui/auth-backend/
link:
	php artisan storage:link
migrate:
	php artisan migrate
seed:
	php artisan migrate:refresh --seed                                       
uploads:
	cp -r ../common/uploads/ storage/app/public/