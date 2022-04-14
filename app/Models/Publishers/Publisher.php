<?php

namespace App\Models\Publishers;

use App\Models\Authors\Author;
use App\Models\Books\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
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
        return $this->hasMany(Book::class, 'publisher_id', 'id');
    }
    public function authors(){
        return $this->belongsToMany(Author::class, 'author_publisher', 'publisher_id', 'author_id');
    }
}
