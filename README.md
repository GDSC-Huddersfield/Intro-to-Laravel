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

## Table of Contents

<!--ts-->
   * [Table of Contents](#table-of-contents)
   * [GitPod Setup](#gitpod-setup)
   * [Setup Migration](#setup-migration)
   * [Setup Factory](#setup-factory)
   * [Setup Model](#setup-model)
   * [Setup Resource](#setup-resource)
   * [Setup Controller](#setup-controller)
      * [Setup Index method](#setup-index-method)
      * [Setup Store method](#setup-store-method)
      * [Setup Show method](#setup-show-method)
      * [Setup Update method](#setup-update-method)
      * [Setup Destroy method](#setup-destroy-method)
   * [Setup Routes](#setup-routes)
   * [Manual Testing](#manual-testing)
<!--te-->

## GitPod Setup

Click the button below to create a new Workspace (uses Laravel template):

[![Open in GitPod with Laravel template](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/GDSC-Huddersfield/GitPod-Laravel-Template)

## Create Model, Migration and Factory files

Run the following command to create migration and factory for  ```Todo``` model:

```
php artisan make:Model Todo -mf
```

## Setup Migration

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

## Setup Factory
In ```./database/factories/TodoFactory.php```, specify the fields to generate dummy content for:

```php
public function definition()
{
    return [
        'name' => $this->faker->name(),
        'description' => $this->faker->sentence(),
    ];
}
```

## Setup Model

In ```./app/Models/Todo.php```, add the following 

```php
class Todo extends Model
{
    // $casts property converts attributes to common data types .
    // E.g. treat some property, which has 0 and 1 values (in databaes), as boolean values.
    // Learn more at https://laravel.com/docs/8.x/eloquent-mutators#attribute-casting
    protected $cast = [
        'finished' => 'boolean',
    ];
}
```

## Setup Resource

Create ```TodoResource``` using:

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

## Setup Controller

Create a resource controller using:

```
php artisan make:controller TodoController --model=Todo --resource
```

Import the ```TodoResource``` and ```Todo``` model like so:

```php
<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource; // 👈 this line
use Illuminate\Http\Request;
...
```

### Setup Index method

```php
public function index()
{
    return TodoResource::collection(Todo::all());
}
```

### Setup Store method

```php
public function store(Request $request)
{
    return new TodoResource(Todo::create($request->toArray()));
}
```

### Setup Show method

```php
public function show(Todo $todo)
{
    return new TodoResource($todo);
}
```

### Setup Update method

```php
public function update(Request $request, Todo $todo)
{
    $todo->update($request->toArray());

    return new TodoResource($todo);
}
```

### Setup Destroy method

```php
public function destroy(Todo $todo)
{
    $todo->delete();

    return response('Todo Deleted', 204);
}
```

## Setup Routes

In ```./routes/api.php```, import the ```TodoController``` class:

```php
<?php

use App\Http\Controllers\TodoController; // 👈 Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

...
```


Next, add the following at the end of ```./routes/api.php```, to create API endpoints (URL in simply terms)

```php
...

Route::get('/todo', [TodoController::class, 'index',]);
Route::post('/todo', [TodoController::class, 'store']);
Route::put('/todo/{$id}', [TodoController::class, 'update']);
Route::get('/todo/{$id}', [TodoController::class, 'show']);
Route::delete('/todo/{$id}', [TodoController::class, 'destroy']);
```

💡However, all the same endpoints can be created by using ```apiResource``` method like so

```php
Route::apiResource('todo', TodoController::class);
```

If using the ```apiResource``` method, then remove the 5 routes created in previous setup.


## Manual Testing

Test all routes using [HoppScotch](https://hoppscotch.io).

Use ```php artisan route:list``` to view the API end points in your application.
