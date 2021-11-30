# Laravel from Scratch - Wrokshop 2

This is a [Laravel with MySQL](https://laravel.com) application developed for week 2 of laravel from scratch.

## TODO:
- Add validation for requests.
- more testing around that validation
- make TODO's belong to users
- make policy so a user can only manipulate there own todos.


## Notes & caveats

- This app was built in an hour bare that in mind when looking at the source code, there may be mistakes.
- This api is only covering the basics of an API Next week we will look at adding Authentication to this application.
- this example was built with TDD in mind but if you dont have experience with that you can use postman to test the API endpoints.

# Workshop Guide

## GitPod Setup

Click the button below to create a new Workspace (uses Laravel template):

[![Open in GitPod with Laravel template](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/GDSC-Huddersfield/GitPod-Laravel-Template)

## Create Model, Migration and Factory files

Run the following command to create migration and factory for  ```Todo``` model:

```
php artisan make:Model Todo -mf
```

## Migration

Edit the ```up``` function in ```./database/migrations/[TIME_STAMP]_create_todo_table.php```

```php
public function up()
{
    Schema::create('todos', function (Blueprint $table) {
        $table->id();
        $table->string("name");
        $table->string("description");
        $table->boolean('finished')->default(false);
        $table->timestamps();
    });
}
```

## Factory
In ```./database/factories/TodoFactory.php```, import ```Todo``` model:

```php
namespace Database\Factories;

use App\Models\Todo; // 👈 Just this line
use Illuminate\Database\Eloquent\Factories\Factory;
```

and specify fields to generate dummy content for:

```php
public function definition()
{
    return [
        'name' => $this->faker->name(),
        'description' => $this->faker->sentence(),
    ];
}
```

## Model

In ```./app/Models/Todo.php```, add the following 

```php
class Todo extends Model
{
    // This ensures all the fields are able to be edited.
    protected $guarded = [];


    // This will cast the finished parameter to a boolean.
    protected $cast = [
        'finished' => 'boolean',
    ];
}
```

## Create Controller

Create a resource controller using:

```
php artisan make:controller TodoController --resource
```

Import the ```TodoResource``` and ```Todo``` model like so:

```php
<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource; // 👈 this line
use App\Models\Todo;                 // 👈 and this line
use Illuminate\Http\Request;
...
```

### Index method:

```php
public function index()
{
    return TodoResource::collection(Todo::all());
}
```

### Store method:

```php
public function store(Request $request)
{
    return new TodoResource(Todo::create($request->toArray()));
}
```

### Show method:

```php
public function show(Todo $todo)
{
    return new TodoResource($todo);
}
```

### Update method:

```php
{
    $todo->update($request->toArray());

    return new TodoResource($todo);;
}
```

### Destroy method:

```php
public function destroy(Todo $todo)
{
    $todo->delete();

    return response('Todo Deleted', 204);
}
```

## Create Routes

In ```./routes/api.php```, import the ```TodoController``` class:

```php
<?php

use App\Http\Controllers\TodoController; // 👈 Just this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

...
```


Next, add the following at the end of ```./routes/api.php```, to create API endpoints (URL in simply terms)

```php
...

Route::get('/todo', ['index', TodoController::class]);
Route::post('/todo', ['store', TodoController::class]);
Route::put('/todo/{$id}', ['update', TodoController::class]);
Route::get('/todo/{$id}', ['show', TodoController::class]);
Route::delete('/todo/{$id}', ['destroy', TodoController::class]);
```

💡However, all the same endpoints can be created by using ```apiResource``` method like so

```php
Route::apiResource('todo', TodoController::class);
```

## Create Resource

Create ``TodoResource```:

```
php artisan make:resource TodoResource
```

Resource is located in ```./app/Http/Resources/TodoResource.php```.

Add the following to ```toArray``` method:

```php
public function toArray($request)
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'finished' => $this->finished,
    ];
}
```


## Populate Controllers

Create a ```TodoController``` by running:

```php
php artisan make:controller TodoController --resource
```


## Test Application


## Manual Testing

Test all routes using [HoppScotch](https://hoppscotch.io).

Use ```php artisan route:list``` to view the API end points in your application.


## Automated Testing


