const elixir = require('laravel-elixir');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts(["resources/assets/js/theme"], 'public/theme/js/all.js' );
});


elixir(function(mix) {
    mix.styles(["resources/assets/css/theme"], 'public/theme/css/all.css' );
});