@extends('layouts.app')

@section('content')
<div class="card-header">メモ新規作成</div>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card-body py-2 px-4 ">
    <form action="/store" method="post">
        @csrf
        <input type='hidden' name='user_id' value="{{ $user['id'] }}">
        <div class="form-group">
            <label for="book">Book Name</label>
            <input name="book" type="text" class="form-control" id="book" placeholder="本のタイトル">
        </div>
        <div class="form-group">
            <label for="page">ページ</label>
            <input name="page" type="text" class="form-control" id="page" value="{{ old('page') }}" placeholder="本のページ">
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
            <input name="title" type="text" class="form-control" id="title" value="{{ old('title') }}" placeholder="メモのタイトル">
        </div>
        <div class="form-group">
            <label for="tag">メモ</label>
            <textarea name="content" class="form-control" rows="10">{{ old('content') }}</textarea>
        </div>
        <div class="form-group section1 text-end">
            <button type="submit" class="btn btn-outline-dark btn-lg">保存</button>
        </div>
    </form>
</div>
@endsection