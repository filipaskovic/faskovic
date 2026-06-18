<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    protected $fillable = ['name','description','price','year','image','featured','stock','category_id','winery_id'];

    // ?
    protected $casts = ['featured' => 'boolean'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function winery(){
        return $this->belongsTo(Winery::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

}
