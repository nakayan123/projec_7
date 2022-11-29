@extends('layouts.layout')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>編集</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        @if($errors->any())
                        <div class ='alret alert-danger'>
                            <ul>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</il>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('post.update',[ 'post' => $blog ])}}" method="post" enctype='multipart/form-data'>
                            @csrf
                            @method('patch')
                            <div id="blog_img">
                            <img src="{{ asset('storage/' . $blog['img']) }}" id="blog_edit"/>
                            </div>
                            <div>
                                <input type="file" name="img" value="{{ $blog['img']}}"/>
                                @csrf
                            </div>
                            <label for='date' class='mt-2'>試合日</label>
                                <input type='date' class='form-control' name='date' id='date' value="{{ $blog['date']}}"/>
                                <label for='amount'>会場</label>
                            <input type='text' class='form-control' name='venue' value="{{ $blog['venue']}}"/>
                            <label for='text' class='mt-2'>メモ</label>
                                <textarea class='form-control' name='text'>{{ $blog['text']}}</textarea>
                            <div class='row justify-content-center'>
                                <input type='submit' value="変更" class='btn btn-success btn-rounded w-25 mt-3'>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<style>
    #blog_img{
        text-align : center;
    }
    #blog_edit{
    width: 200px;
    height: 260px;
    background-size: cover;
    object-fit: cover;
    position: relative;
    }
</style>