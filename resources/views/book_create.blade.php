@extends('layouts.app')

@section('content')
<div class="card-header">本の登録</div>

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
        {{-- <div class="form-group">
            <label for="book">bookname</label>
            <input name="book" type="text" class="form-control" id="book" placeholder="本のタイトル">
        </div> --}}
        <div class="form-group">
            <label for="title">本のタイトル</label>
            <input name="title" type="text" class="form-control" id="title" value="{{ old('title') }}" placeholder="本のタイトル">
        </div>
        
        <div class="form-group section1 text-end">
            <button type="submit" class="btn btn-outline-dark btn-lg">登録</button>
        </div>
    </form>
</div>
@endsection