# Configuración de Larus
Despues de clonar el repositorio realizar los siguientes pasos

### 1) Instalar dependencias de composer
```sh
$ composer install
```

### 2) Crear base de datos y archivo de ambiente
#### 2.1) Esquema de base de datos
```mysql
CREATE SCHEMA `larus_laravel`;
```
#### 2.2) Archivo de ambiente
```php
APP_ENV=local
APP_DEBUG=true
APP_KEY=jXzR5tWWFNuqmZQxqleH633gcaRqZNi2

DB_HOST=localhost
DB_DATABASE=larus_laravel
DB_USERNAME=user_mysql
DB_PASSWORD=password_mysql

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

### 3) Instalar migraciones de la aplicación
```sh
$ php artisan migrate
```
### 4) Verificar los modulos existentes de la aplicación
```sh
$ php artisan module:list
```
### 5) Instalar migraciones de cada modulo

> Por cada modulo existente realizar la instalación de su migración

```php
php artisan module:migrate Dashboard
php artisan module:migrate Notifications
php artisan module:migrate Roles
php artisan module:migrate Tasks
php artisan module:migrate User
```
##### **El modulo (Permissions) no es necesario dado que ya exite la tabla creada desde la migración original**


### 6) Instalación de Seeds de la aplicación y de los modulos
```php
php artisan db:seed
php artisan module:seed Dashboard
php artisan module:seed Notifications
php artisan module:seed Roles
php artisan module:seed Tasks
php artisan module:seed User
php artisan module:seed Permissions
```

### 7) Comprobar instalación 
```sh
php artisan serve
```
> Usuario; test@test.com /
> Password: test

** **
** **
# Configuración de modulo Contabilidad

### 1) Instalar migraciones del modulo

```php
php artisan module:migrate Contabilidad
```

### 2) Agregar parametros a .env

```txt
DIRECTORY_SALES=directorio
```
### 3) Agregar nuevo disco a /config/filesystems.php

```txt
	'disks' => [
	...
        'sales' => [
			'driver' => 'local',
			'root'   => env("DIRECTORY_SALES"),
		],
		...
	]
```

### 4) Agregar comando a /app/Console/Kernel.php

```php
protected $commands = [ 
    ...
    'Modules\Contabilidad\Console\SalesReadCommand' 
    ...
];

protected function schedule(Schedule $schedule) {
...
	$schedule->command('larus:salesRead')->hourly();
...
}
```
### 5) Para poder probar directamente el comando, puede realizarlo desde una terminal con el siguiente comando:
```command
php artisan larus:salesRead
```


### Todos

 - Write Tests
 - 
License
----

MIT

**   **

### Version
1.1.0



