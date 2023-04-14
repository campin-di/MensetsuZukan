set:
	cp ../common/.env .env
	composer update
	composer install
	mkdir -p vendor/laravel/ui/auth-backend/backup
	mkdir storage/app/json/
	cp -r ../MensetsuZukan2/storage/app/public/uploads/ storage/app/public/
	cp ../common/storage/mensetsuzukan-a811af6e10b1.json storage/app/json/
	mv vendor/laravel/ui/auth-backend/AuthenticatesUsers.php vendor/laravel/ui/auth-backend/backup/
	mv vendor/laravel/ui/auth-backend/RegistersUsers.php vendor/laravel/ui/auth-backend/backup/
	mv vendor/laravel/ui/auth-backend/ResetsPasswords.php vendor/laravel/ui/auth-backend/backup/
	mv vendor/laravel/ui/auth-backend/SendsPasswordResetEmails.php vendor/laravel/ui/auth-backend/backup/
	cp ../common/vendor/AuthenticatesUsers.php vendor/laravel/ui/auth-backend/
	cp ../common/vendor/RegistersUsers.php vendor/laravel/ui/auth-backend/
	cp ../common/vendor/ResetsPasswords.php vendor/laravel/ui/auth-backend/
	cp ../common/vendor/SendsPasswordResetEmails.php vendor/laravel/ui/auth-backend/
	php artisan storage:link
migrate:
	php artisan migrate
seed:
	php artisan migrate:refresh --seed                                       
uploads:
	cp -r ../common/uploads/ storage/app/public/