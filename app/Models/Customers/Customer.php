<?php

namespace App\Models\Customers;

use App\Models\Books\Book;
use App\Models\Cart\Cart;
use App\Models\Countries\Country;
use App\Models\Orders\Order;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'country_id',
        'postcode',
        'image',
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function books(){
        return $this->belongsToMany(Book::class, 'carts', 'customer_id', 'book_id');
    }
    public function cart(){
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
    public function orders(){
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    public function wishlist(){
        return $this->belongsToMany(Book::class, 'wishlist')->withTimestamps();
    }
    public function getWishlistIfExist($bookId){
        return self::wishlist()->where('book_id', $bookId)->exists();
    }
}
