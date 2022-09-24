# Minimal

A minimalist PHP framework.

## Usage
### Routing
Routes should be added to [index.php](index.php)
```php
$router->get('/hello', function() { echo 'Hello World'; });
```

Alternatively, routes can reference a controller. The following route will look for `HelloWorldController::index()` in [App/Controllers/](App/Controllers/)

```php
$router->get('/hello', 'HelloWorldController::index');
```

### Controllers
Controllers should be added to [App/Controllers/](App/Controllers/)

`App/Controllers/HelloWorldController.php`:

```php
...
class ExampleController {

    public static function index() {
        echo 'Hello World';
    }
...
```
