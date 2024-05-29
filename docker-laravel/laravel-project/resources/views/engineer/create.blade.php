<!-- resources/views/engineer/create.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エンジニア登録フォーム</title>
</head>
<body>
    <h1>エンジニア登録フォーム</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('engineer.store') }}" method="POST">
        @csrf
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br><br>

        <label for="age">年齢:</label>
        <input type="number" id="age" name="age" value="{{ old('age') }}"><br><br>

        <button type="submit">登録する</button>
    </form>
</body>
</html>