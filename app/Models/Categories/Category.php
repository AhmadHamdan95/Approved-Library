<?php

namespace App\Models\Categories;

use App\Models\Books\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function books(){
        return $this->belongsToMany(Book::class, 'book_category', 'category_id', 'book_id');
    }
}
