<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public function myMemo($user_id){
        $book = \Request::query('book');
        // dd($user_id);
        if(empty($book)){
            return $this::select('memos.*')->where('user_id', $user_id)->where('status', 1)->get();      
        }else{
        // もしタグの指定があればタグで絞る ->wher(tagがクエリパラメーターで取得したものに一致)
          $memos = $this::select('memos.*')
              ->leftJoin('books', 'books.id', '=','memos.book_id')
              ->where('books.title', $book)
              ->where('books.user_id', $user_id)
              ->where('memos.user_id', $user_id)
              ->where('memos.status',1)
              ->get();
          return $memos;
        }
    }
    
}
