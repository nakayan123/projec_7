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
        @if( Auth::user()->role === 0 && Auth::user()->id === $userid->id)
            <a href="{{ route('account.edit',['account' => Auth::user()->id]) }}" class="card-link">アカウント編集</a>
        @endif
        @endforeach
        </div>
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
                        @foreach($commentId as $commentid)
                            <div class="media-body comment-body">
                                <div class="row ml-1"> 
                                    <div id="comment-data">{{ $commentid->comment }}</div>
                                </div>
                                <small class="text-muted comment-body-time" id="created_at">{{ $commentid->created_at }}</small>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('ajax.form') }}" method="post">
                    @csrf
                        <input type="text" name="comment" id="text" value="">
                        <input type="hidden" name="blog_id" value="{{ $blogId['id'] }}">
                        <input type="button" class="ml-2 mt-2" id="button" value="コメント投稿">
                    </form>
                    </div>
                    <p class="text-right">
                    @if( Auth::user()->role === 0 && Auth::user()->id === $userid->id)
                    <a href="{{ route('edit.blog',['blog' => $blogId]) }}">
                        <button type="button" class="btn btn-success btn-rounded" id="p_btn">編集</button>
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
    $('#button').click(function() {
        var blog_id = $('input[name="blog_id"]').val();
        var comment = $('input[name="comment"]').val();
        var textForm = document.getElementById("text");
        function clearText() {
            textForm.value = '';
            }
        console.log(1);
        $.ajax({
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
            url: "/result/ajax/",
            dataType: "json",
            type: 'POST',
            data: {'comment': comment,
                    'blog_id': blog_id},
        }).done(function (data) {
                    var html = `
                                <div class="media comment-visible">
                                    <div class="media-body comment-body">
                                        <div class="row ml-1">       
                                            <span class="comment-body-content" id="comment">${data.comments.comment}</span>
                                        </div>
                                        <small class="text-muted comment-body-time" id="created_at">${data.comments.created_at}</small>
                                    </div>
                                </div>
                            `;
                    $("#comment-data").prepend(html); 
        }).fail(function (jqXHR, textStatus, errorThrown) {
                //通信が失敗したときの処理
                $('#error_message').empty();
                var text = $.parseJSON(jqXHR.responseText);
                var errors = text.errors;
                for (key in errors) {
                    var errorMessage = errors[key][0];
                    $('#error_message').append(`<li>${errorMessage}</li>`);
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
    position: relative;
    }
    #text{
        margin-left: 30px;
    }
    .scroll{
    height: 300px;
    overflow: auto;
    overflow-x: hidden;
    }
    #created_at{
    margin-left: 150px;
    }
    #p_btn{
        margin-right: 25px;
    }
</style>
@endsection
