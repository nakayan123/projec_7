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
        <div class="card-body">
        <a href="#" class="card-link">フォロー</a>
        </div>
        @if( Auth::user()->role === 0 && Auth::user()->id === $userid->id)
        <div class="card-body">
            <a href="{{ route('account.edit',['account' => Auth::user()->id]) }}" class="card-link">アカウント編集</a>
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
                    <div class="form-control col-md-12 scroll">
                        <div id="comment-data"></div>
                    </div>
                    @section('js')
                        <script src="{{ asset('js/comment.js') }}"></script>
                    @endsection
                    <form action="{{ route('ajax.form',[ 'blog' => $blogId]) }}" method="get">
                        <input type="text" name="comment" value="">
                        <input type="submit" class="ml-2 mt-2" id="btn" value="コメント投稿">
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
<script>
    $(function() {

$("#btn").click(function(){
function get_data() {
    $.ajax({
        url: "result/{blog}/ajax/",
        dataType: "json",
        success: data => {
    $("#comment-data")
        .find(".comment-visible")
        .remove();

    for (var i = 0; i < data.comments.length; i++) {
        var html = `
                    <div class="media comment-visible">
                        <div class="media-body comment-body">
                            <div class="row">
                                <span class="comment-body-user" id="name">${data.comments[i].name}</span>
                                <span class="comment-body-time" id="created_at">${data.comments[i].created_at}</span>
                            </div>
                            <span class="comment-body-content" id="comment">${data.comments[i].comment}</span>
                        </div>
                    </div>
                `;

        $("#comment-data").append(html);
    }
},
        error: () => {
            alert("ajax Error");
        }
    });

    setTimeout("get_data()", 5000);
}
});
});
</script>
<style>
    #blog_img{
    margin: 5px;
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
