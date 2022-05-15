@extends('layouts.app')

@section('content')
<div class="card-header d-flex justify-content-between">本更新画面
    <form method='POST' action="/delete/{{$book['id']}}" id='delete-form'>
        @csrf
        <input type='hidden' name='book_id' value="{{ $book['id'] }}">
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
    <form action="/update/{{ $book['id'] }}" method="post">
        @csrf
        <input type='hidden' name='book_id' value="{{ $book['id'] }}">
        {{-- <div class="form-group">
            <label for="book">bookname</label>
            <input name="book" type="text" class="form-control" id="book" placeholder="本のタイトル">
        </div> --}}

        <div class="form-group">
            <label for="title">タイトル</label>
            <input name="title" type="text" class="form-control" id="title" value="{{ $book['title'] }}">
        </div>

        <div class="form-group section1 text-end">
            <button type="submit" class="btn btn-outline-dark btn-lg">更新</button>
        </div>
    </form>
</div>
@endsection