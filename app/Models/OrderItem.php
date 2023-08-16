<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'prod_id',
        'qty',
        'price'
    ];

    public function products(){
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
