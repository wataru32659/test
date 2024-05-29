<!-- resources/views/engineer/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">エンジニア編集画面</h1>
        <form action="{{ route('engineer.update', $engineer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">名前:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $engineer->name }}">
                <label for="name">年齢:</label>
                <input type="text" class="form-control" id="age" name="age" value="{{ $engineer->age }}">
            </div>
            <div class="form-group">
                <label for="file">ファイルを選択:</label>
                <input type="file" class="form-control-file" id="file" name="file">
            </div>
            <!-- 他のフィールドもここに追加 -->
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
@endsection