# Minimal

A minimalist PHP framework.

## Usage
- [Routing](#routing) 
- [Controllers](#controllers) 
- [Views](#views) 
- [Helpers](#helpers) 

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
\
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
\
### Views
Views should be added to [App/Views/](App/Views/)

`App/Views/hello/index.php`:

```html
<h1>Hello world</h1>
```

`index.php`:

```php
$router->get('/hello', function() {
    View::render('hello/index');
});
```

Views can also accept parameters

`App/Views/hello/index.php`:

```html+php
<h1><?php echo $text ?></h1>
```

```php
$router->get('/hello', function() {
    $text = 'Hello World';

    View::render('hello/index', [
        'text' => $text,
    ]);
});
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
\
### Helpers

#### `redirect()`
Redirects to another path
```php
$router->get('/hello', function() { redirect('/goodbye'); });
```

#### `active()`
Returns whether the current path is active
```php
$router->get('/hello', function() { echo active('/hello') ? 'active' : 'inactive'; });
```

`active()` is particularly helpful for dynamically displaying content in a view.

For example, to underline a link to the currently loaded page:
```html+php
<a href="/hello" style="text-decoration: <?php echo active('/hello') ? 'underline' : 'none' ?>">
    This text is underlined if link is active
</a>
```

#### `debug()`
Prints formatted output for debugging
```php
$router->get('/hello/{name}', function() { debug($name); });
```

#### `dd()`
Prints formatted output for debugging and immediately exits
```php
$router->get('/hello/{name}', function() {
    dd($name);

    View::render('hello/index'); // View will not render
});
```
