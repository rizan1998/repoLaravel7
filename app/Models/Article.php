<?php

namespace App\Models; //default adalah App\ tapi karena ada dalam satu folde ubah
//name spacenya menjadi App\Models

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    // protected = 'my_articles';  jika table nya tidak kovensional atau tidak plural
    // public $timestamps = false; //jika tidak ingin menggunakan created_at dan updated_at
    // protected $fillable = ['title', 'subject'];  protected disini yang boleh di input din controller
    //jadi sebaiknya pakai yang tidak boleh di mass assigment

    //jadi masukinnya yg tidak boleh mass assigment yaitu id
    protected $guarded = ['id']; //jadi yang tidak boleh di mass assigment adalah id dan sisanya boleh


}
