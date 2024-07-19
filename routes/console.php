<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('migrate:fresh', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');

Artisan::command('migrate', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');

Artisan::command('migrate:refresh', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');

Artisan::command('migrate:install', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');

Artisan::command('migrate:reset', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');

Artisan::command('migrate:rollback', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');

Artisan::command('db:seed', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');

Artisan::command('db:wipe', function () {
    $this->comment('Please don\'t run any artisan command regarding database, it can break your database!');
})->purpose('Preventing causing break database.');
