# Note Taking Project

## 2025-07-28 Test up and running


### API Check Section

- [ ] user registration
- [ ] user login
- [ ] list of notes
- [ ] note create
- [ ] note update
- [ ] note delete




## First Time Setup Code

```bash
composer install

php artisan migrate:fresh

# provide complete seed for testing up and runnning , user role
php artisan db:seed


php artisan serve 
```
## JWT Case
```bash 
composer require tymon/jwt-auth
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
put this secret key to bottom  .env file like 
example:JWT_SECRET=7xLpaztJuBncwiT56m9qZ4kMFdX3sueKYnd03gxrPQy8NKDH3vLUmoZcWhY9uzta

# open localhost:8000/admin 
# login using 
# email : admin@mail.com
# password : password

```


## API Documentation

provide postman collection link 👇
### Registration	
POST	    
http://127.0.0.1:8000/api/v1/register

### Login	        
POST	    
http://127.0.0.1:8000/api/v1/register

### Lists	        
GET	        
http://127.0.0.1:8000/api/v1/notes

### Detail	        
GET	        
http://127.0.0.1:8000/api/v1/notes/ {id}

### Create Notes        
POST	    
http://127.0.0.1:8000/api/v1/notes

### Update Notes
PUT	        
http://127.0.0.1:8000/api/v1/notes/ {id}

### Delete Notes       
DELETE	    
http://127.0.0.1:8000/api/v1/notes/ {id}


## Bash Logs

all the bash we type

```bash
php artisan make:seeder RoleSeeder
php artisan make:seeder UserSeeder
```

