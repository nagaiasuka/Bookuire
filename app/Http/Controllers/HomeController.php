<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Memo;
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
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();
     
        return view('create',compact('user','memos'));
    }

    public function create()
    {
        $user = Auth::user();
        // メモの取得
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();

        return view('create',compact('user','memos'));
    }

    public function store(Request $request)
    {
       $data = $request->all();
       $memo_id = Memo::insertGetId([
            'page' => $data['page'],
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $data['user_id'], 

            'status' => 1
        ]);
   
        // リダイレクト処理
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $memo = Memo::where('id',$id)->where('user_id',$user['id'])->where('status',1)->first();
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->get();
        return view('edit',compact('memo','user','memos'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        Memo::where('id',$data['memo_id'])->update(['title'=>$data['title'],'page'=>$data['page'],'content'=>$data['content']]);
        
        // リダイレクト処理
        return redirect()->route('edit',['id'=>$data['memo_id']]);
    }

    public function delete($id)
    {
        Memo::where('id',$id)->update(['status'=>2]);
        return redirect()->route('index');
    }
}
