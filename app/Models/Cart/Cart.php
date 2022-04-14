<?php

namespace App\Models\Cart;

use App\Models\Books\Book;
use App\Models\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'book_id',
        'customer_id',
    ];

    protected $appends = [
        'total'
    ];

    public function getTotalAttribute()
    {

        return $this->quantity * $this->book->price;

    }

    public function book(){
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
