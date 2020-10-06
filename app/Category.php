<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //fillable untuk menggunkan seed
    protected $fillable = ['name', 'slug'];

    //set up relasi
    //setiap kategory memiliki banyak post
    public function posts() //posts plural karena banyak
    {
        return $this->hasMany(Post::class);
        // jika tidak default return $this->hasMany(Post::class, 'subject');


    }
}
