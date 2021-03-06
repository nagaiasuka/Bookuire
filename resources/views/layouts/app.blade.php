<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://kit.fontawesome.com/0a60730688.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grape+Nuts&family=Zen+Maru+Gothic:wght@300&display=swap" rel="stylesheet">
    <style>
        div { /*セレクタに font-family を指定*/
            font-family: 'Grape Nuts', cursive;
            font-family: 'Zen Maru Gothic', sans-serif;
        }
      </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Bookuire</a>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- {{ $user["name"] }} --}}
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @if(session('success'))
            <div class="alert alert-success m-0" role="alert">
              {{ session('success') }}
            </div>
        @endif
        <div class="row p-0 m-0" style="height: 92vh;">
            <div class="col-md-3 p-0 m-0">
                <div class="card h-100 p-0 m-0">
                    <div class="card-header">本一覧</div>
                    <div class="card-body py-2 px-4">
                        <a class='d-block' href='/'>全て表示</a>
                        @foreach ($books as $book)
                            <div class="d-flex align-items-center">
                                <div class="pr-1rem" >
                                    
                                    
                                    <form method='POST' action="/book_delete/{{$book['id']}}" id='delete-form'>
                                        @csrf
                                        <input type='hidden' name='memo_id' value="{{ $book['id'] }}">
                                        <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
                                    </form> 

                                </div>
                                <a href="/?book={{ $book['title'] }}" class="d-block p-0">{{ $book['title'] }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-0 m-0">
                <div class="card h-100 p-0 m-0">
                    <div class="card-header">メモ一覧<a class='ml-auto' href='/create'><i class="fas fa-plus-circle"></i></a></div>
                    <div class="card-body py-2 px-4">
                        @foreach ($memos as $memo)
                            <a href="/edit/{{ $memo['id'] }}" class="d-block">{{ $memo['title'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- メモ新規作成 -->
            <div class="col-md-6 p-0 m-0">
                <div class="card h-100 p-0 m-0">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
