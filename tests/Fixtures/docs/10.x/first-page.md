# First Page

- [Introduction](#introduction)
  - [Supercharging Blade With Livewire](#supercharging-blade-with-livewire)
- [Displaying Data](#displaying-data)
  - [HTML Entity Encoding](#html-entity-encoding)
    - [Displaying Unescaped Data](#displaying-unescaped-data)
  - [Blade and JavaScript Frameworks](#blade-and-javascript-frameworks)
    - [Rendering JSON](#rendering-json)
    - [The `@verbatim` Directive](#the-verbatim-directive)

<a name="introduction"></a>
## Introduction

Blade is the simple, yet powerful templating engine that is included with Laravel. Unlike some PHP templating engines, Blade does not restrict you from using plain PHP code in your templates. In fact, all Blade templates are compiled into plain PHP code and cached until they are modified, meaning Blade adds essentially zero overhead to your application. Blade template files use the `.blade.php` file extension and are typically stored in the `resources/views` directory.

Blade views may be returned from routes or controllers using the global `view` helper. Of course, as mentioned in the documentation on [views](/docs/{{version}}/views), data may be passed to the Blade view using the `view` helper's second argument:

    Route::get('/', function () {
        return view('greeting', ['name' => 'Finn']);
    });

<a name="supercharging-blade-with-livewire"></a>
### Supercharging Blade With Livewire

Want to take your Blade templates to the next level and build dynamic interfaces with ease? Check out [Laravel Livewire](https://livewire.laravel.com). Livewire allows you to write Blade components that are augmented with dynamic functionality that would typically only be possible via frontend frameworks like React or Vue, providing a great approach to building modern, reactive frontends without the complexities, client-side rendering, or build steps of many JavaScript frameworks.

<a name="displaying-data"></a>
## Displaying Data

You may display data that is passed to your Blade views by wrapping the variable in curly braces. For example, given the following route:

    Route::get('/', function () {
        return view('welcome', ['name' => 'Samantha']);
    });

You may display the contents of the `name` variable like so:

```blade
Hello, {{ $name }}.
```

> [!NOTE]  
> Blade's `{{ }}` echo statements are automatically sent through PHP's `htmlspecialchars` function to prevent XSS attacks.

You are not limited to displaying the contents of the variables passed to the view. You may also echo the results of any PHP function. In fact, you can put any PHP code you wish inside of a Blade echo statement:

```blade
The current UNIX timestamp is {{ time() }}.
```

<a name="html-entity-encoding"></a>
### HTML Entity Encoding

By default, Blade (and the Laravel `e` function) will double encode HTML entities. If you would like to disable double encoding, call the `Blade::withoutDoubleEncoding` method from the `boot` method of your `AppServiceProvider`:

    <?php

    namespace App\Providers;

    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            Blade::withoutDoubleEncoding();
        }
    }

<a name="displaying-unescaped-data"></a>
#### Displaying Unescaped Data

By default, Blade `{{ }}` statements are automatically sent through PHP's `htmlspecialchars` function to prevent XSS attacks. If you do not want your data to be escaped, you may use the following syntax:

```blade
Hello, {!! $name !!}.
```

> [!WARNING]  
> Be very careful when echoing content that is supplied by users of your application. You should typically use the escaped, double curly brace syntax to prevent XSS attacks when displaying user supplied data.

<a name="blade-and-javascript-frameworks"></a>
### Blade and JavaScript Frameworks

Since many JavaScript frameworks also use "curly" braces to indicate a given expression should be displayed in the browser, you may use the `@` symbol to inform the Blade rendering engine an expression should remain untouched. For example:

```blade
<h1>Laravel</h1>

Hello, @{{ name }}.
```

In this example, the `@` symbol will be removed by Blade; however, `{{ name }}` expression will remain untouched by the Blade engine, allowing it to be rendered by your JavaScript framework.

The `@` symbol may also be used to escape Blade directives:

```blade
{{-- Blade template --}}
@@if()

<!-- HTML output -->
@if()
```

<a name="rendering-json"></a>
#### Rendering JSON

Sometimes you may pass an array to your view with the intention of rendering it as JSON in order to initialize a JavaScript variable. For example:

```blade
<script>
    var app = <?php echo json_encode($array); ?>;
</script>
```

However, instead of manually calling `json_encode`, you may use the `Illuminate\Support\Js::from` method directive. The `from` method accepts the same arguments as PHP's `json_encode` function; however, it will ensure that the resulting JSON is properly escaped for inclusion within HTML quotes. The `from` method will return a string `JSON.parse` JavaScript statement that will convert the given object or array into a valid JavaScript object:

```blade
<script>
    var app = {{ Illuminate\Support\Js::from($array) }};
</script>
```

The latest versions of the Laravel application skeleton include a `Js` facade, which provides convenient access to this functionality within your Blade templates:

```blade
<script>
    var app = {{ Js::from($array) }};
</script>
```

> [!WARNING]  
> You should only use the `Js::from` method to render existing variables as JSON. The Blade templating is based on regular expressions and attempts to pass a complex expression to the directive may cause unexpected failures.

<a name="the-at-verbatim-directive"></a>
#### The `@verbatim` Directive

If you are displaying JavaScript variables in a large portion of your template, you may wrap the HTML in the `@verbatim` directive so that you do not have to prefix each Blade echo statement with an `@` symbol:

```blade
@verbatim
    <div class="container">
        Hello, {{ name }}.
    </div>
@endverbatim
```
