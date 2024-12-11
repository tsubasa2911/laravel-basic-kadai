<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller {
    public function index() {
        $posts = DB::table('posts')->get();
        return view('posts/index', compact('posts'));
    }

    public function show($id) {
        $post = Post::find($id);

        // 変数$postをposts/show.blade.phpファイルに渡す
        return view('posts.show', compact('post'));
        }

        public function create() {
            return view('posts.create');
        }
        public function store(Request $request) {
            // バリデーションを設定
            $request->validate([
                'title' => 'required|max:20',
                'content' => 'required|max:200'
            ]);
            // フォームの入力内容をもとに、テーブルにデータを追加す
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();

            // レイダイレクトする
            return redirect("/posts");
        }
}
