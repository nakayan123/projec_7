<div id="app">
        @extends('layouts.layout')
        @section('content')
    <div class="row justify-content-around">
        <form action="" method="GET">
            <input type="text" name="keyword" value="">
            <input type="submit" value="検索">
        </form>
        </div>
    </div>           
    @foreach($blog as $blogs)
    <div class="card mb-3 d-flex container" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $blogs->img ) }}" id="blog_image"/>
            </div>
            <div class="col-md-8" id="card">
                <div class="card-body">
                    <h3 class="card-title" id="line">{{ $blogs->name }}</h3>
                    <p class="card-text">競技：{{ $blogs->competition }}</p>
                    <p class="card-text">日程：{{ $blogs->date }}</p>
                    <p class="card-text">
                    <a href="{{ route('blog.detail',['blog' => $blogs->id]) }}">詳細</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if( Auth::user()->role === 0 )
    <div class="card-body row justify-content-around">
        <div>
            <a href="{{ route('account.edit',['account' => Auth::user()->id]) }}">
                <button type="button" class="btn btn-success btn-rounded">アカウント編集</button>
            </a>
            <a href="{{ route('blog.new') }}">
                <button type="button" class="btn btn-success btn-rounded">新規投稿</button>
            </a>
        </div>
    </div>
    @endif
    <div class="row justify-content-around">
    
    {{ $blog->appends(Request::only('keyword'))->links() }}
    </div>
    @endsection
</div>
<style>
    #blog_image{
    margin: 5px;
    margin-left: -5px;
    width: 200px;
    height: 260px;
    background-size: cover;
    object-fit: cover;
    position: relative;
    }
    #card{
    /* margin-left: 5px; */
    }
    #line {
    text-decoration:
     underline;
     font-family: serif;
    }
</style>