<?php

namespace App\Models;
use App\Models\User;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
      'user_id',
      'prod_id',
      'user_review'
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function ratings(){
        return $this->belongsTo(Rating::class,'user_id','user_id');
    }

    public function products(){
        return $this->belongsTo(Product::class,'prod_id','id');
    }

}
