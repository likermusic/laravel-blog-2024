<?php

namespace App\Http\Controllers;

use App\Post;
use App\Post_User;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $posts = Post::get_posts();
        $favourites = User::find(auth()->id())->posts;   
        return view('home', compact('posts', 'favourites'));
    }

    public function store(Request $request) {
        //Добавить проверку что юзер авторизован прежде чем доб в избранное или через middleware в роутах
        if (!auth()->check()) {
            return redirect()->route('user.login')->with('error', 'Пожалуйста, войдите в систему, чтобы добавить пост в избранное.');
        }
        // dd($request->postId);
        // auth()->id();
        $post = Post::find($request->postId);

          // Проверяем, что пост существует
        if (!$post) {
            return redirect()->back()->with('error', 'Пост не найден');
        }
        //get использовать нельзя тк он получает обчыно данные из тбл в рез SELECT
        // $is_user_has_post = $post->users()->where('id','=', auth()->id())->get();
        //exists - дает булев рез
        // $is_user_has_post = $post->users()->where('id','=', auth()->id())->exists();
        //нужно сразу так по связанной тбл проверять. exists(), который проверяет, есть ли запись в таблице post_user для текущего post_id и user_id. Если запись существует, он возвращает true, иначе false.

        $is_user_has_post = $post->users()->where('user_id', auth()->id())->exists();
        
        // dump($is_user_has_post);
        if (!$is_user_has_post) {
            $post->users()->attach(auth()->id());
            return redirect()->home()->with('success', 'Пост добавлен в избранное');
        } else {
            return redirect()->home()->with('fail', 'Пост уже в избранном');
        }

       //Или вообще можно обойтись без проверок. Этот метод гарантирует, что дубликаты не будут добавлены
    //    $post->users()->syncWithoutDetaching(auth()->id());


        //для удаления поста из избранного
        //$post->users()->detach(auth()->id());
    }

    public function delete(Request $request) {
        if (!auth()->check()) {
            return redirect()->route('user.login')->with('error', 'Пожалуйста, войдите в систему, чтобы удалить пост из избранного');
        }
        dd($request);
    }
}
