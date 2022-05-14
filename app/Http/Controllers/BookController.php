<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        // メモの取得
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();

        return view('book_create',compact('user','memos'));
    }
}
