<?php

namespace App\Models\OrderAddresses;

use App\Models\Countries\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'postcode',
        'country_id',
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
