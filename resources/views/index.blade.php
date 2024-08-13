@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">スレッド投稿</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('thread.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-1 col-form-label text-md-end">件名</label>

                            <div class="col-md-8">
                                <input id="title" type="text" name="title" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-1 col-form-label text-md-end">本文</label>

                            <div class="col-md-8">
                                <textarea name="content" id="content" class="form-control"></textarea>
                            </div>
                        </div>

                        
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-1">
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            @foreach($threads as $thread) 
                <div class="card mt-3">
                    <div class="card-header">
                        ID: {{$thread->id}} <br>
                        投稿者: {{$thread->user->name}} <br>
                        件名: <a href="{{route('thread.show', ['thread' => $thread->id])}}">{{$thread->title}}</a>
                        <p> 返信{{$thread->replies_count}}件</p>
                        @if(Auth::user()->id == $thread-> user_id)
                            <form action="{{route('thread.destroy', $thread->id)}}" method="post">
                                <input type="hidden" name="page" value="{{request()->input('page')}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('このコメントを削除しますか?');">削除</button>
                            </form>
                        @endif    
                    </div>
                    
                    <div class="card-body">
                        {!! nl2br(e($thread->content)) !!}
                    </div>    
                </div>
            @endforeach
            {!! $threads->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection
