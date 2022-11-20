<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;




class DisplayController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $query = Blog::query()
        ->select('blogs.id','user_id', 'date', 'text', 'img', 'users.id as userId', 'name', 'memo' , 'competition' ,'image')
        ->join('users','blogs.user_id','=','users.id')
        ;
        if(!empty($keyword))
        {
          $blog = $query->where('name','like','%'.$keyword.'%')
          ->orWhere('competition','like','%'.$keyword.'%')
          ->orderBy('blogs.created_at','desc')
          ->paginate(3);
        return view('home',[
            'blog' => $blog
        ]);
        }else{
            $blog = $query->orderBy('blogs.created_at','desc')
            ->paginate(3);
            return view('home',[
                'blog' => $blog
            ]);
        }

    }
    public function blogDetail(Blog $blog){
        $blogs = $blog->user_id;
        $user = DB::table('users')
        ->where('id' , '=', $blogs )
        ->get(); 
        
        return view('blog_home',[
            'blogId' => $blog,
            'userId' => $user
        ]);
    }
}
