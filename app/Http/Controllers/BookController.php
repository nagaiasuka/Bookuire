<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        // メモの取得
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();
        // bookの取得
        $books =Book::where('user_id', $user['id'])->where('status',1)->get();

        return view('book_create',compact('user','memos','books'));
    }

    public function store(Request $request)
    {
        $inputs=$request->validate([
            'title' =>'required|max:100',
        ]);

        $user = Auth::user();
        // dd($user['id']);
        $book_id = Book::insertGetId([
            'title' => $inputs['title'],
            'status' => 1,
            'user_id'=>$user['id'],
        ]);

        // リダイレクト処理
        return redirect()->route('home')->with('success','本の登録が完了しました！');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $book = Book::where('id',$id)->where('user_id',$user['id'])->where('status',1)->first();
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();
        // bookの取得
        $books =Book::where('user_id', $user['id'])->where('status',1)->get();
        return view('book_edit',compact('book','user','memos','books'));
    }
}
