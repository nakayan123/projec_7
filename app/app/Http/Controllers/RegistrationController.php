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
        $blog_img = $request->file('img')->store('public');
                // name属性が'thumbnail'のinputタグをファイル形式に、画像をpublic/avatarに保存
        // $image_path = $request->file('image')->store('public/avatar/');
                // 上記処理にて保存した画像に名前を付け、userテーブルのthumbnailカラムに、格納
        $record->img = basename($blog_img);

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
        $blog = $request->file('image')->store('public');
                // name属性が'thumbnail'のinputタグをファイル形式に、画像をpublic/avatarに保存
        // $image_path = $request->file('image')->store('public/avatar/');
                // 上記処理にて保存した画像に名前を付け、userテーブルのthumbnailカラムに、格納
        $record->image = basename($blog);
        $columns = ['name', 'competition', 'memo'];
    
        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
    
        $record->save();
    
        return redirect('/');
    } 
    public function blogEditForm(Blog $blog) {
        
        return view('blog_edit',[
            'blog' => $blog
        ]);
        }  
    
    public function blogEdit(Blog $blog, Request $request) {
        
        $record = $account;
        $blog_img = $request->file('img')->store('public');
                // name属性が'thumbnail'のinputタグをファイル形式に、画像をpublic/avatarに保存
        // $image_path = $request->file('image')->store('public/avatar/');
                // 上記処理にて保存した画像に名前を付け、userテーブルのthumbnailカラムに、格納
        $record->img = basename($blog_img);
        $columns = ['date', 'venue', 'text'];
    
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
