@extends('layouts.app')

@section('content')
<div class="card-header">メモ新規作成</div>
<div class="card-body py-2 px-4 ">
    <form action="/store" method="post">
        @csrf
        <input type='hidden' name='user_id' value="{{ $user['id'] }}">
        {{-- <div class="form-group">
            <label for="book">bookname</label>
            <input name="book" type="text" class="form-control" id="book" placeholder="本のタイトル">
        </div> --}}
        <div class="form-group">
            <label for="page">ページ</label>
            <input name="page" type="text" class="form-control" id="page" placeholder="本のページ">
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="メモのタイトル">
        </div>
        <div class="form-group">
            <label for="tag">メモ</label>
            <textarea name="content" class="form-control" rows="10"></textarea>
        </div>
        <div class="form-group section1 text-end">
            <button type="submit" class="btn btn-outline-dark btn-lg">保存</button>
        </div>
    </form>
</div>
@endsection