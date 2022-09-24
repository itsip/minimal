# Minimal

A minimalist PHP framework.

## Usage
### Routing
Routes should be added to [index.php](index.php)
```php
$router->get('/hello', function() { echo 'Hello World'; });
```

Routes can also accept parameters
```php
$router->get('/hello/{name}', function($name) { echo 'Hello ' . $name; });
```

Alternatively, routes can reference a controller. The following route will look for and call `HelloWorldController::index()` in [App/Controllers/](App/Controllers/)

```php
$router->get('/hello', 'HelloWorldController::index');
```

### Controllers
Controllers should be added to [App/Controllers/](App/Controllers/)

`App/Controllers/HelloWorldController.php`:

```php
class HelloWorldController {

    public static function index() {
        echo 'Hello World';
    }

}
```

### Views
Views should be added to [App/Views/](App/Views/)

`App/hello/index.php`:

```html+php
<h1><?php echo $text ?></h1>
```

`App/Controllers/HelloWorldController.php`:

```php
class HelloWorldController {

    public static function index() {
        $text = 'Hello World';

        View::render('hello/index', [
            'text' => $text,
        ]);
    }

}
```

Rendered views will always be inserted into the contents of [App/Views/main.php](App/Views/main.php)

`App/Views/main.php`:
```html+php
<!DOCTYPE html>
<html lang="en">
...
    <?php include $view . '.php' ?>
...
</html>
```
