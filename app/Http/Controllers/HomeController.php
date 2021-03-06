<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Book;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // メモの取得
        // $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();
        $memoModel=new Memo();
        $memos=$memoModel->myMemo(Auth::id());
        $books = Book::where('user_id', $user['id'])->where('status',1)->get();
     
        return view('create',compact('user','memos','books'));
    }

    public function create()
    {
        $user = Auth::user();
        // メモの取得
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();
        // 本の取得
        $books = Book::where('user_id', $user['id'])->where('status',1)->get();
        
        return view('create',compact('user','memos','books'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $inputs=$request->validate([
            'book' =>'required',
            'page' =>'required|numeric',
            'title' =>'required|max:100',
            'content' =>'required',      
        ]);

        $exist_book = Book::where('user_id', $user['id'])->where('title',$data['book'])->first();
        if(empty($exist_book['id'])){
            $book_id = Book::insertGetId([
                'title' => $inputs['book'],
                'user_id' => $data['user_id'], 
                'status' => 1
            ]);
        }else{
            $book_id =$exist_book['id'];
        }


        $memo_id = Memo::insertGetId([
            'page' => $inputs['page'],
            'title' => $inputs['title'],
            'content' => $inputs['content'],
            'user_id' => $data['user_id'], 
            'book_id' => $book_id, 

            'status' => 1
        ]);

        // リダイレクト処理
        return redirect()->route('home')->with('success','メモの作成が完了しました！');
    }

    public function edit($id)
    {
        $user = Auth::user();
       
        $memo = Memo::where('id',$id)->where('user_id',$user['id'])->where('status',1)->first();
        $book = Book::where('id',$memo['book_id'])->where('user_id',$user['id'])->where('status',1)->first();
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();
        $books = Book::where('user_id', $user['id'])->where('status',1)->get();
        // dd($book);
        return view('edit',compact('memo','user','memos','books','book'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $inputs=$request->validate([
            'title' =>'required|max:100',
            'page' =>'required|numeric',
            'content' =>'required',
        ]);
        // dd($data);

        $user = Auth::user();
        Memo::where('id',$data['memo_id'])->update(['title'=>$inputs['title'],'page'=>$inputs['page'],'content'=>$inputs['content'],'book_id'=>$data['book_id']]);
        
        // リダイレクト処理
        return redirect()->route('edit',['id'=>$data['memo_id']])->with('success','メモの更新が完了しました！');;
    }

    public function delete($id)
    {
        Memo::where('id',$id)->update(['status'=>2]);
        return redirect()->route('index')->with('success','メモの削除が完了しました！');;
    }

    public function book_delete($id)
    {
        $user = Auth::user();
        // dd($id);
        $memos = Memo::where('book_id',$id)->where('user_id',$user['id'])->where('status',1)->get();

        foreach($memos as $memo){
            if($memo['status'] === 1){
                return redirect()->route('index')->with('success','有効なメモがありますので本を削除できません！');;
            }
        }
        Book::where('id',$id)->update(['status'=>2]);
        return redirect()->route('index')->with('success','本を削除しました！');;


        
    }
}
