<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            //isi table ini adalah relasi dari kedua table
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('tag_id')->constrained('tags'); //keduanya primary ker jadi jika ada duplikat table maka tidak bisa
            $table->primary(['post_id', 'tag_id']);

            //membuat foregnKey dimana jika post atau tag dihapus maka ke dua2nya akan terhapus rownya cara dibawah sama dengan
            //menambah constrained('posts')
            //$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); //posts dan tags adala nama tablenya
            //$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
