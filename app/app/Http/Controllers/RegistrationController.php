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
