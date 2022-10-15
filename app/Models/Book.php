<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'author', 'genre', 'description', 'image', 'isbn', 'published', 'publisher'];
    protected $table = "books";

    public static function getElasticIndexName()
    {
        return 'books';
    }
}
