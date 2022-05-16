@extends('layouts.app')

@section('content')
<div class="card-header d-flex justify-content-between">メモ更新画面
    <form method='POST' action="/delete/{{$memo['id']}}" id='delete-form'>
        @csrf
        <input type='hidden' name='memo_id' value="{{ $memo['id'] }}">
        <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
    </form>  
</div>
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
    <form action="/update/{{ $memo['id'] }}" method="post">
        @csrf
        <input type='hidden' name='memo_id' value="{{ $memo['id'] }}">      
        <div class="form-group">
            <label for="book">Book Name</label>
            <select class='form-control' name='tag_id'>
            @foreach($books as $book)
                <option value="{{ $book['id'] }}" {{ $book['id'] == $memo['book_id'] ? "selected" : "" }}>{{$book['title']}}</option>
            @endforeach
        </select>
            {{-- <input name="book" type="text" class="form-control" id="book" value="{{ $book['title']}}" placeholder="本のタイトル"> --}}
        </div>
        <div class="form-group">
            <label for="page">ページ</label>
            <input name="page" type="text" class="form-control" id="page" value="{{ $memo['page'] }}">
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
            <input name="title" type="text" class="form-control" id="title" value="{{ $memo['title'] }}">
        </div>
        <div class="form-group">
            <label for="tag">メモ</label>
            <textarea name="content" class="form-control" rows="10">{{ $memo['content'] }}</textarea>
        </div>
        <div class="form-group section1 text-end">
            <button type="submit" class="btn btn-outline-dark btn-lg">更新</button>
        </div>
    </form>
</div>
@endsection