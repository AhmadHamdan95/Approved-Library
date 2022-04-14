<?php

namespace App\Models\Books;

use App\Models\Authors\Author;
use App\Models\Cart\Cart;
use App\Models\Categories\Category;
use App\Models\Customers\Customer;
use App\Models\Publishers\Publisher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'publisher_id',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }
    public function authors(){
        return $this->belongsToMany(Author::class, 'author_book', 'book_id', 'author_id');
    }
    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }
    public function customers(){
        return $this->belongsToMany(Customer::class, 'carts', 'book_id', 'customer_id');
    }
    public function cart(){
        return $this->hasMany(Cart::class, 'book_id', 'id');
    }
}
