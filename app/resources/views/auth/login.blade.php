@extends('layouts.layout')

@section('content')
<div class="row justify-content-center">
  <p class="moji">
  " There is only one way to succeed in <br>
anything and that is to give it everything."

  </p>
</div>
  <div class="container" id="login">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-7">
        <nav class="card mt-2">
          <div class="card-header">ログイン</div>
          <div class="card-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="d-flex">
                <div class="form-group">
                  <label for="email">メールアドレス</label>
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                </div>
                <div class="form-group ml-3">
                  <label for="password">パスワード</label>
                  <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="form-group ml-3 mt-4">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>
              </div>
            </form>
          </div>
 
        </nav>
      </div>
    </div>
  </div>
@endsection
<style>
  @import url('https://fonts.googleapis.com/css?family=Anton');
  .moji{
    font-family: 'Anton', sans-serif;
    margin-top: 100px;
    font-size: 50px;
    font-weight: 600;
  line-height: 1;
    background: -webkit-linear-gradient(#3498db 0%, #9b59b6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  }
  #login{
    margin-top: 230px;
  }
</style>