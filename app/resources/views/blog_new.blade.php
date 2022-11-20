@extends('layouts.layout')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>新規投稿</h1>
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
                        <form action="" method="post">
                            @csrf
                            <!-- <label for='img'>画像</label>
                                <input type='text' class='form-control' name='' value=""/> -->
                            <label for='date' class='mt-2'>試合日</label>
                                <input type='date' class='form-control' name='date' id='date' value="{{ old('date')}}"/>
                                <label for='amount'>会場</label>
                                <input type='text' class='form-control' name='venue' value=""/>
                            <label for='text' class='mt-2'>メモ</label>
                                <textarea class='form-control' name='text'></textarea>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection