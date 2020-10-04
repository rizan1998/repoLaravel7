<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    //mengatur relasi many to many
    public function posts()
    {
        return $this->belongsToMany(Post::class); //tidak perlu memasukan parameter karena laravel sudah menganggap
        //bahwa yg bersangkutan adalah 'post_tag'
    }
}
