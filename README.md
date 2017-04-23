# php-router

An example (very simple) PHP router/dispatcher system for learning purposes.

## Setup

```shell
$ git clone https://github.com/jordanbrauer/php-router.git
$ cd ./php-router
$ composer install
```

## Usage

### Boilerplate

Start by requiring the `autoload.php` file, using the class, and instantiating a new router like so,

```php
require_once 'vendor/autoload.php';

use \Jorb\Router\Router as Router;

$router = new Router();
```

### API

Now that you have a new router you can start using, it is time to read about the routers' API and put it to the test!

#### `add()`

> `Router::add(string $route, mixed $method);`

Add a route to the router.

__Example:__ obligartory hello world

```php
$router->add('/', function () {
  echo 'Hello World!';
});
```

__Example:__ Route w/ argument

```php
$router->add('/user/.+', function ($user) {
  echo "Welcome {$user}!";
});
```

__Example:__ Route w/ many arguments

_Note: this feature is currently bugged and does not work as intended. The dispatch method will match multiple routes if a longer route such as the one below contains an already existing shorter route in its' path._

```php
$router->add('/user/.+/repository/.+', function($user, $repository) {
  echo "Repository: {$user}/{$repository}";
})
```

#### `dispatch()`

> `Router::dispatch();`

Route the user to all appropriate destinations when requested.

__Example:__

```php
$router->dispatch();
```
