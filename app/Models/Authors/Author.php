<?php

namespace App\Models\Authors;

use App\Models\Books\Book;
use App\Models\Publishers\Publisher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'image',
        // 'author_publisher',
    ];

    public function books(){
        return $this->belongsToMany(Book::class, 'author_book', 'author_id', 'book_id');
    }
    public function publishers(){
        return $this->belongsToMany(Publisher::class, 'author_publisher', 'author_id', 'publisher_id');
    }
}
