# php-router

An example (very simple) PHP router/dispatcher system for learning purposes.

## Setup

```shell
$ git clone https://github.com/jordanbrauer/php-router.git
$ cd ./php-router
$ composer install
```

## Usage

Start by requiring the `autoload.php` file, using the class, and instantiating a new router like so,

```php
require_once 'vendor/autoload.php';

use \Jorb\Router\Router as Router;

$router = new Router();
```

Now you have a new router to start using. Read about the routers' API below.

### `add()`

Add a route to the router.

> `Router::add(string $route, mixed $method);`

__Example: obligartory hello world__

```php
$router->add('/', function () {
  echo 'Hello World!';
});
```

__Example: Route w/ argument__

```php
$router->add('/user/.+', function ($user) {
  echo "Welcome {$user}!";
});
```

__Example: Route w/ many arguments__

_Note: this feature is currently bugged and does not work as intended. The dispatch method will match multiple routes if a longer route such as the one below contains an already existing shorter route in its' path._

```php
$router->add('/user/.+/repository/.+', function($user, $repository) {
  echo "Repository: {$user}/{$repository}";
})
```

### `dispatch()`

Route user to appropriate destinations when requested

> `Router::dispatch();`

```php
$router->dispatch();
```
