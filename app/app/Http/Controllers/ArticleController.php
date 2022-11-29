<?php

namespace App\Http\Controllers;
use App\Blog;
use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateData;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateData $request)
    {
        $blog = new Blog;
        $record = $blog;
        $userId = Auth::user()->id;
        if(!empty($request->img)){
            $blog_img = $request->file('img')->store('public');
            $record->img = basename($blog_img);
        }
        $record->user_id = $userId;
        $columns = ['date', 'venue', 'text'];
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
        $record->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
    //   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $post)
    {
        return view('blog_edit',[
            'blog' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Blog $post, CreateData $request)
    {       $record = $post;
        if(!empty($request->img)){
            $blog_img = $request->file('img')->store('public');
            $record->img = basename($blog_img);
        }
        $columns = ['date', 'venue', 'text'];
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }    
        $record->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $post)
    {
        $post->delete();
        return redirect(route('home.form'))->with('success', 'ブログ記事を削除しました');
    }
}
