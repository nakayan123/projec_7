<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function newBlogForm() {

        return view('blog_new');
        }  
    
    public function newBlog(Request $request) {
        
        $blog = new Blog;
        $record = $blog;
        $userId = Auth::user()->id;

        $record->user_id = $userId;

        $columns = ['date', 'venue', 'text'];
    
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
    
        $record->save();
    
        return redirect('/');
    }  
    public function accountEditForm(User $account) {
        
        return view('account_edit',[
            'account' => $account
        ]);
        }  
    
    public function accountEdit(User $account, Request $request) {
        
        $record = $account;



        $columns = ['name', 'competition', 'memo'];
    
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
    
        $record->save();
    
        return redirect('/');
    } 
    public function deleteBlogForm(Blog $blog) {
        
        $blog -> delete();
    
        return redirect('/');
    }  
}
