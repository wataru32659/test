<!-- resources/views/engineer/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">エンジニア一覧画面</h1>
<!-- 検索フォーム -->
<div class="card mb-3">
    <div class="card-body text-center">
        <h2 class="card-title">エンジニア検索</h2>
        <form action="{{ route('engineer.search') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 mb-2">
                    <label for="name">名前:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3 mb-2">
                    <label for="ageMax">年齢以上:</label>
                    <input type="text" name="ageMax" id="ageMax" class="form-control">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="ageMin">年齢以下:</label>
                    <input type="text" name="ageMin" id="ageMin" class="form-control">
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">検索</button>
                    <a href="{{ route('engineer.create') }}" class="btn btn-secondary">登録画面</a>
                </div>
            </div>
        </form>
    </div>
</div>

        <!-- エンジニア一覧 -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">エンジニア一覧</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">名前</th>
                            <th scope="col">詳細</th>
                            <th scope="col">編集</th>
                            <th scope="col">削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($engineers as $engineer)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $engineer->name }}</td>
                                <td>
                            <a href="{{ route('engineer.show', ['engineer' => $engineer->id]) }}" class="btn btn-secondary">詳細</a>
                        </td>
                        <td>
                            <a href="{{ route('engineer.edit', ['engineer' => $engineer->id]) }}" class="btn btn-primary">編集</a>
                        </td>
                        <td>    
                            <form id="delete-form-{{ $engineer->id }}" action="{{ route('engineer.updateFlag', ['engineer' => $engineer->id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $engineer->id }}').submit();" class="btn btn-danger">削除</a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
