<?php

namespace App\Models\OrderItems;

use App\Models\Books\Book;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'price',
        'quantity',
        'order_id',
        'book_id',
    ];
    
    protected $appends = [
        'total'
    ];

    public function getTotalAttribute(){
        return $this->price * $this->quantity;
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
