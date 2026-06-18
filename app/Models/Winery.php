<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winery extends Model
{
    protected $fillable = ['name','region','country','description','logo'];

    public function wines(){
        return $this->hasMany(Wine::class);
    }
}
