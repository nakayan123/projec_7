<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateData;
use App\Http\Requests\CreateCreate;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function newBlogForm()
    {

        return view('blog_new');
    }  
    
    public function newBlog(CreateData $request)
    {
        $blog = new Blog;
        $record = $blog;
        $userId = Auth::user()->id;
        $blog_img = $request->file('img')->store('public');
        $record->img = basename($blog_img);
        $record->user_id = $userId;
        $columns = ['date', 'venue', 'text'];
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
        $record->save();
        return redirect('/');
    }  
    public function accountEditForm(User $account)
    {
        return view('account_edit',[
            'account' => $account
        ]);
    }  
    
    public function accountEdit(User $account, CreateCreate $request)
    {   
        $record = $account;
        if(!empty($request->image)){
        $blog = $request->file('image')->store('public');
        $record->image = basename($blog);
        }
        $columns = ['name', 'competition', 'memo'];
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
        $record->save();
        return redirect('/');
    } 
    public function blogEditForm(Blog $blog)
    {
        
        return view('blog_edit',[
            'blog' => $blog
        ]);
    }  
    
    public function blogEdit(Blog $blog, CreateData $request)
    {
        $record = $blog;
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
    public function deleteBlogForm(Blog $blog)
    {
        $blog -> delete();
        return redirect('/');
    } 
    public function ajaxForm(Request $request)
    {
        $user = Auth::user();
        $comment = $request->input('comment');
        $blog_id = $request->input('blog_id');
        $comments = Comment::create([
            'user_id' => $user->id,
            'blog_id' => $blog_id,
            'comment' => $comment
        ]);
        $json = ["comments" => $comments];
    return response()->json($json);
    }
}
