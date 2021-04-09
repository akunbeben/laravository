<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Laravository - Repository Pattern for Laravel
Simplified Repository pattern implementation in Laravel.

## Requirement
- Laravel 8.x

## Installation

Execute the following command to get the latest version of the package:
```
composer require akunbeben/laravository
```

Execute the following command to create the RepositoryServiceProvider:
```
php artisan repository:provider
```

Go to the `config/app.php` and add this `App\Providers\RepositoryServiceProvider::class` to your providers config:

The `RepositoryServiceProvider` will work as Dependency Injection.

```php
'providers' => [
  ...
  App\Providers\RepositoryServiceProvider::class,
],

```

## Methods

Akunbeben\Laravository\Repositories\Interfaces

- getAll();
- getById($id, $relations = null)
- create($attributes)
- update($id, $attributes)
- delete($id)

## Usage
### Create a new Repository
To create repository, you just need to run like this: 
```
php artisan make:repository User
```

You can also add `-m` or `--model` option to generate the Model: 
```
php artisan make:repository User -m
```
So you don't need to create Model manually.

You can find out the generated files under the App\Repositories\ folder:

- Repository: App\Repositories\Eloquent\
- Interface: App\Repositories\Interfaces\

#### UserRepository.php
```php
namespace App\Repositories\Eloquent;

use Akunbeben\Laravository\Repositories\Eloquent\BaseRepository;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
  protected $model;

  /**
   * Your model to use the Eloquent
   * 
   * @param User $model
   */
  public function __construct(User $model)
  {
    $this->model = $model;
  }
}
```

#### UserRepositoryInterface.php
```php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    
}
```

After you created the repositories. you need to register your Class and Interface in the `RepositoryServiceProvider.php`

```php
...
class RepositoryServiceProvider extends ServiceProvider
{
  ...
  public function register()
  {
    ...
    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
  }
}
```

Now you can implement it to your Controller. Like this example below:

```php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository) {
    $this->userRepository = $userRepository;
  }
}

```

So your Controller will much cleaner and much shorter.
```php
class UserController extends Controller
{
  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository) {
    $this->userRepository = $userRepository;
  }

  ...

  public function store(SomeFormRequest $request)
  {
    return $this->userRepository->create($request->validated());
  }
}
```