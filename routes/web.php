<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'hello';
    // return view('welcome');
});

Route::get('/testdata', function () {
    $p1 = new Book(['title' => 'my title', 'description' => 'my descrdescription descriptioni ption', 'author' => 'nikunj', 'genre' => 'kothiya', 'image' => 'https://loremflickr.com/480/320/book', 'isbn' => '9780441232840', 'published' => '2022-05-16', 'publisher' => 'multipz']);
    $p1->save();
    dd('done');
});
