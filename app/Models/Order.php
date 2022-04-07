<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','fname','lname','email','phone','address1','address2',
                     'city','state','country','pincode','total_price','status','message','tracking_no'];


     public function orderitems()
     {
         return $this->hasMany(OrderItem::class,'order_id');
     }  
     
     public function users()
     {
         return $this->belongsTo(User::class,'user_id');
     }  
}
