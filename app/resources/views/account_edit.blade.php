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
                        <form action="{{ route('account.edit',[ 'account' => $account ]) }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            <div  id="account_edit">
                            <img src="{{ asset('storage/' . $account['image']) }}"/>
                            </div>
                            <div>
                                <input type="file" name="image" />
                                @csrf
                            </div>
                            <label for='name'>チーム名</label>
                                <input type='text' class='form-control' name='name' value="{{ $account['name'] }}"/>
                            <label for='competition'>競技</label>
                                <input type='text' class='form-control' name='competition' value="{{ $account['competition'] }}"/>
                            <label for='memo' class='mt-2'>チーム情報</label>
                                <textarea class='form-control' name='memo'>{{ $account['memo'] }}</textarea>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-success btn-rounded w-25 mt-3'>変更</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<style>
    #account_edit{
        text-align : center;
    }
</style>