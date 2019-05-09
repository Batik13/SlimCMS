# SlimCMS
CMS system on microframework Slim 3

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development.

### Installation
```
git clone https://github.com/Batik13/SlimCMS.git
```

### Сonnect dependencies
```
composer update
```
### Create tables
Run this code for the next database - **db.sql**

### Set up a database connection
Open file **src/settings.php** and write down the necessary database settings:
```
...
'db' => [
  'driver' => 'mysql',
  'host' => 'localhost',
  'database' => 'you_database',
  'username' => 'you_username',
  'password' => 'you_password',
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix' => '',
],
...
```

### Admin panel
The administrative zone can be reached at the following address - **site.ru/auth/signin**
