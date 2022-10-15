<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('books', BookController::class);
Route::post('searchData', [BookController::class, 'searchData']);

Route::get('getData/{param}', function ($param) {
    // get data
    $books = Book::where(
        function ($query) use ($param) {
            return $query
                ->where('title', 'LIKE', '%' . $param . '%')
                ->orWhere('description', 'LIKE', '%' . $param . '%')
                ->orWhere('genre', 'LIKE', '%' . $param . '%')
                ->orWhere('author', 'LIKE', '%' . $param . '%');
        }
    )->get();

    return response($books, 200);
});
