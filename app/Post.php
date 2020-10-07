<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //method untuk tinker
    public function scopeLatestFirst()
    {   //kembalikan nilai data terakhir
        return $this->latest()->first();
    }

    //protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];
    protected $guarded = ['id']; //digunakan jika itu hanya form sendiri

    public function category() //singular
    {
        // return $this->hasOne(Category::class); ///hanya memiliki satu row yang bisa di select
        return $this->belongsTo(Category::class); //ini langsung memberi tahu file relasinya
        //jiak  manual  = return $this->belongsTo(Category::class, 'subject');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //untuk relasi dengan table user
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //function untuk mengambil image
    public function takeImage()
    {
        return "storage/" . $this->thumbnail;
    }
}
