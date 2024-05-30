<!-- resources/views/engineer/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">エンジニア詳細画面</h1>
</div>
<body>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row justify-content-center">
    <form action="{{ route('engineer.store') }}" method="POST">
        @csrf
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br>
        <label for="age">年齢:</label>
        <input type="number" id="age" name="age" value="{{ old('age') }}"><br>
        <button type="submit">登録する</button>
    </form>
</div>
@endsection