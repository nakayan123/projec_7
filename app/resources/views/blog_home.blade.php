@extends('layouts.layout')
@section('content')
<div class="row justify-content-around mt-3">
    <div class="card" style="width: 18rem;">
        <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/062.webp" class="card-img-top" alt="Chicago Skyscrapers"/>
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        @foreach($userId as $userid)
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
            <img
                src="https://mdbcdn.b-cdn.net/wp-content/uploads/2020/06/vertical.webp"
                alt="Trendy Pants and Shoes"
                class="img-fluid rounded-start"
            />
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">日程：{{ $blogId['date'] }}</p>
                    <p class="card-text">会場：{{ $blogId['venue'] }}</p>
                    <p class="card-text">内容
                    <p class="col-sm">{!! nl2br(e($blogId['text'])) !!}</p>
                    <label for='comment' class='mt-2'>コメント</label>
                    <div class="col-md-3 scroll">
                        <div name='comment'></div>
                        <div class="row justify-content-around">
                        <form action="" method="GET">
                            <input type="text" name="comment" value="">
                            <input type="submit" value="コメント投稿">
                        </form>
                        </div>
                    </div>
                    <p class="card-text">
                    @if( Auth::user()->role === 0 && Auth::user()->id === $userid->id)
                    <a href="">
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
    .scroll{
  height: 80px;
  overflow: auto;
    }
</style>
@endsection
