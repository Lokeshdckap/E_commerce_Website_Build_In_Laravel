<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
class order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'name',
        'lname',
        'email',
        'phone',
        'total',
        'address_1',
        'address_2',
        'city',
        'state',
        'country',
        'pincode',
        'payment_mode',
        'payment_id',
        'order_status',
        'tracking_no',
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
