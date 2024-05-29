<!-- resources/views/engineer/index.blade.php -->
@extends('layouts.app')

@section('title', 'Show')
<div class="container">
    <h1 class="text-center">エンジニア詳細画面</h1>
</div>

@section('menubar')
@parent
詳細ページ
@endsection

@section('content')
<table>
    <tr>
        <th>No:</th>
        <td>{{$engineer->id}}</td>
    </tr>
    <tr>
        <th>名前:</th>
        <td>{{$engineer->name}}</td>
    </tr>
    <tr>
        <th>年齢:</th>
        <td>{{$engineer->age}}</td>
    </tr>
</table>

<!-- PDFファイルを表示 -->
@if ($engineer->file)
<embed src="{{ asset('storage/skillsheet/' . $engineer->id . '/' . basename($engineer->file->path)) }}" type="application/pdf" width="100%" height="600px"></embed>
@endif

@endsection