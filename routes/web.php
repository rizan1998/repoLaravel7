<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Http\Request; //untuk mengambil request ini jika
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/welcome', function () {
//     $postBody = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo quisquam illum nostrum est sapiente 
//      sed veniam, ut voluptatibus perspiciatis reiciendis eum, quas provident error et nobis nesciunt accusamus sint, 
//      laboriosam neque hic rerum necessitatibus corporis. Maiores veniam consequatur enim perferendis possimus 
//      molestias assumenda sit a dicta saepe facilis officia commodi temporibus explicabo tempore, repellendus, 
//      cupiditate libero! Ab eos, earum eius quos adipisci, accusantium dolor placeat maxime quasi ut error officiis 
//      totam. Corrupti ad, molestiae esse numquam enim nostrum nobis vitae dolorem expedita odit itaque distinctio 
//      temporibus. Aspernatur ad voluptatibus ipsum aut incidunt porro eius harum necessitatibus, commodi earum ut.';
//     return view('welcome', ['body' => $postBody]);
// });

//========>syntax dibawah jika kita menggunakan class use Illuminate\Http\Request

// Route::get('/home', function (Request $request) {
//     //return $request->fullUrl(); //for get the full Url
//     //return $request->path(); //ntuk mengambil path atau urlnya setelah domainnya
//     return $request->path() == "home" ? true : false;
//     //return view('home');
// });

//========>syntax dengan tidak menggunakan class Request
Route::get('/', function () {
    //return request()->path() == "home" ? true : false;
    //lebih simple atau lebih short
    //return request()->is('home') ? 'sama' : 'tidak';
    return view('home');
});

//route group digunakan untuk meng group route sehingga tidak perlu ladi 
//memberikan satu2 functionnya seperti function dibawah
//Route::get('posts', 'PostController@index')->middleware('auth')->name('posts.index');

Route::prefix('posts')->middleware('auth')->group(function () {
    Route::get('', 'PostController@index')->name('posts.index')->withoutMiddleware('auth');
    Route::get('create', 'postController@create')->name('posts.create');
    Route::post('store', 'postController@store');
    Route::get('{post:slug}/edit', 'postController@edit');
    Route::patch('{post:slug}/edit', 'postController@update');
    Route::delete('{post:slug}/delete', 'postController@delete');
    Route::get('{post:slug}', 'postController@show')->withoutMiddleware('auth');
});

Route::get('categories/{category:slug}', 'CategoryController@show');
Route::view('/contact', 'contact');
Route::view('/about', 'about');
Route::view('/login', 'login');
Route::get('tags/{tag:slug}', 'TagController@show');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
