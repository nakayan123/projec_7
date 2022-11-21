@extends('layouts.layout')
@section('content')
<div class="row justify-content-around mt-3">
    <div class="card" style="width: 18rem;">
    @foreach($userId as $userid)
    <img src="{{ asset('storage/' . $userid->image) }}" />
        <div class="card-body">
            <h5 class="card-title">フォロワー</h5>
        </div>
        
        <ul class="list-group list-group-light list-group-small">
            <li class="list-group-item px-4">{{ $userid->name }}</li>
            <li class="list-group-item px-4">競技：{{ $userid->competition }}</li>
            <li class="list-group-item px-4">
                <p class="border-bottom border-danger">チーム情報</p> 
                <p>{!! nl2br(e($userid->memo)) !!}</p>
            </li>
        </ul>
        @if( Auth::user()->role === 0 && Auth::user()->id === $userid->id)
        <div class="card-body">
            <a href="{{ route('account.edit',['account' => Auth::user()->id]) }}" class="card-link">アカウント編集</a>
            <a href="#" class="card-link">Another link</a>
        </div>
        @endif
        @endforeach
    </div>
    <div class="card" style="width: 50rem;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="{{ asset('storage/' . $blogId['img']) }}" id="blog_img"/>
            </div>
            <div class="col-md-7" id="text">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">日程：{{ $blogId['date'] }}</p>
                    <p class="card-text">会場：{{ $blogId['venue'] }}</p>
                    <p class="card-text">内容
                    <p class="col-sm">{!! nl2br(e($blogId['text'])) !!}</p>
                    <label for='comment' class='mt-2'>コメント</label>
                    <div class="col-md-3 scroll">
                        <div name='comment'></div>
                    </div>
                    <div class="row justify-content-around">
                    <form action="" method="GET">
                        <input type="text" name="comment" value="">
                        <input type="submit" value="コメント投稿">
                    </form>
                    </div>
                    <p class="card-text">
                    @if( Auth::user()->role === 0 && Auth::user()->id === $userid->id)
                    <a href="{{ route('edit.blog',['blog' => $blogId]) }}">
                        <button type="button" class="btn btn-success btn-rounded">編集</button>
                    </a>
                    <a href="{{ route('delete.blog',['blog' => $blogId]) }}">
                        <button type="button" class="btn btn-success btn-rounded">削除</button>
                    </a>
                    @endif
                    </p>
                </div>
            </div>
        </div>
    </div>    
</div>
<style>
    #blog_img{
    width: 300px;
    height: 400px;
    background-size: cover;
    object-fit: cover;
    object-position: 100% 5%;
    position: relative;
    }
    #text{
        margin-left: 30px;
    }
    .scroll{
  height: 80px;
  overflow: auto;
    }
</style>
@endsection
