<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public static function get_posts() {

        // $posts = Post::with(['category' => function ($query) {
        //     $query->select('id', 'name');
        // }])->get()->toArray();

        
        // $posts = Post::all();
        
        // foreach ($posts as $post) {   
            // dump(Category::find($post->category_id)->get(['name'])->toArray());
        // }
        // dump($posts);


        $posts = Post::with('category:id,name')->get();

        // $posts = Post::all();
        // foreach ($posts as  $post) {
        //     $post->category_id = $post->category->name;
        // }

        // foreach ($posts as $post) {
        //     dump($post->category->name);
        // }
       
        return $posts;
    }

    public function users() {
        return $this->belongsToMany(User::class, 'post_user');
        // return $this->belongsToMany(User::class, 'post_user');

        
    }
}


