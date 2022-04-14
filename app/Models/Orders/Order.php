<?php

namespace App\Models\Orders;

use App\Models\Customers\Customer;
use App\Models\OrderAddresses\OrderAddress;
use App\Models\OrderItems\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
        'status',
        'payment_status',
        'customer_id',
        'address_id',
    ];

    protected $appends = [
        'total'
    ];

    public function getTotalAttribute(){
        return $this->items->sum(function($item){
            return $item->price * $item->quantity;
        });
    }

    
    public function items(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function address(){
        return $this->belongsTo(OrderAddress::class, 'address_id', 'id');
    }
}
