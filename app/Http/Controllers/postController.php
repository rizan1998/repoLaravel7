<?php

namespace App\Http\Controllers;

use App\{Post, Category, Tag}; //karena ada di direktori yang sama
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class postController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except([
    //         'index', 'show' //yang tidak terproteksi
    //     ]);
    // middlewarenya dipindahkan jadi di route
    // }


    public function index()
    {

        //Post::get('title', 'slug');
        //Post::take(2)->get(); jika data yang diambil hanya 2
        //$post = Post::get();
        $post = Post::with('author', 'tags', 'category')->latest()->paginate(9); //untuk full pagination
        //$post = Post::simplePaginate(2); //simple pagination
        //return Post::with('author', 'tag', 'category')->latest()->get();
        return view('posts.index', compact('post'));
    }

    public function show(Post $post)
    {
        // tanda \DB untuk kembali ke atas
        // $post = \DB::table('posts')->where('slug', $slug)->first(); //dengan memakai basic
        //dd($post);

        // untuk mengambil data yang mirip
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        //$post = Post::where('slug', $post)->firstOrFail(); //tambah \App untk menggunakan
        //class modelnya first untuk menampilkan satu data, firstOrFail jika datanya ada tampilkan
        //jika tidak ada maka auto redirect ke 404
        //cara2 pengecekan

        // if (is_null($post)) {
        //     abort(404);
        // }

        //cara yang lebih ringan
        // if (!$post) {
        //     abort(404);
        // }


        return view('posts.show', compact('post', 'posts'));
    }
    public function create()
    {
        return view('posts.create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]); //'post' untuk mengisi var yang tidak ada dalam form
        //tambah data karena form yang digunakan itu adalah form edit

    }
    public function store(PostRequest $request) //request disini adalah  class
    //yang di aliaskan ke requrest Var
    {
        //dd(request()->file('thumbnail'));
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        //dd(request('tags'));
        //validation
        // $this->validate($request, [
        //     'title' => 'required',
        //     'body' => 'required'
        // ]);
        // $request->validate([
        //     'title' => 'required|min:3|max:10',
        //     'body' => 'required'
        // ]);

        // ini adalah tipe post tanpa filelable
        // $post = new Post;
        // $post->title = $request->title; // The first post
        // $post->slug = \Str::slug($request->title); // the-first-post
        // $post->body = $request->body;
        // $post->save();

        //post dengan fillable
        // Post::create([
        //     'title' => $request->title,
        //     'slug' => \Str::slug($request->title),
        //     'body' => $request->body
        // ]);

        //post dengan fillable tapi di singkat lagi
        // $post = $request->all(); //all disini adalah sebuah array assosiative
        // //jadi bisa ditambahkan array lagi
        // $post['slug'] = \Str::slug($request->title);
        // Post::create($post);


        //super simple siytax with validation
        // $attr  = $request->validate([
        //     'title' => 'required',
        //     'body' => 'required'
        // ]);
        // $this->RequestValidate();
        $attr = $request->all();
        $thumbnail = request()->file('thumbnail');

        //$attr['slug'] = \Str::slug($request->title);
        //$attr['category_id'] = request('category');
        //$post = Post::create($attr);
        //$post->tags()->attach(request('tags')); //tags mengambil dari model

        //more supert than super short syntax jika tidak menggunakan request class
        // $attr  = request()->validatie([
        //     'title' => 'required',
        //     'body' => 'required'
        // ]);
        $slug = \Str::slug(request('title'));
        $attr['slug'] = $slug;
        //$thumbnailUrl = $thumbnail->store("images/posts");
        if (request()->file('thumbnail')) {
            $thumbnail->storeAs("images/posts", "{$slug}.{$thumbnail->extension()}");
        } else {
            $thumbnail = null;
        }
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        //$attr['user_id'] = auth()->id();
        //$post = Post::create($attr);
        //post dengan user_id
        $post = auth()->user()->posts()->create($attr); //posts diambil dari model
        // mengambil relasi di model
        $post->tags()->attach(request('tags')); //dari model relasi
        session()->flash('success', 'new post is added');
        return redirect('/posts');
        //return back(); //redirect /post/create
    }

    public function edit(Post $post)
    {
        //return view('posts.edit', compact('post'));
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $this->authorize('update', $post); //untuk mencegah user mengedit yang bukan miliknya
        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('images/posts');
        } else {
            $thumbnail = $post->thumbnail;
        }
        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;
        $post->update($attr);
        $post->tags()->sync(request('tags')); //untuk mengupdate data tags yang baru
        return redirect('posts');
        //return back();
    }

    public function delete(Post $post)
    {
        if (auth()->user()->is($post->author)) {
            \Storage::delete($post->thumbnail);
            $post->tags()->detach(); //untuk menghapus data pada relasi atau pada table post_tag
            $post->delete();
            session()->flash('success', 'the post was destroyed');
            return redirect('posts');
        } else {
            session()->flash('error', 'user_id not same, you canot delete this post');
            return redirect('posts.show', []);
        }
    }

    public function RequestValidate()
    {
        return $attr  = request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
    }
}
