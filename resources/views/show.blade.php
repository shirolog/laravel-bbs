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
                <div class="card-header">返信投稿</div>

                <div class="card-body">
                    <form method="POST" action="{{route('reply.store', ['thread' => $thread->id])}}">
                        <input type="hidden" name="thread_id" value="{{$thread->id}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="content" class="col-md-1 col-form-label text-md-end">本文</label>

                            <div class="col-md-8">
                                <textarea name="content" id="content" class="form-control"></textarea>
                            </div>
                        </div>

                        
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-1">
                                <button type="submit" class="btn btn-primary">投稿</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


                <div class="card mt-3">
                    <div class="card-header">
                        ID: {{$thread->id}} <br>
                        投稿者: {{$thread->user->name}} <br>
                        件名: <a href="{{route('thread.show', ['thread' => $thread->id])}}">{{$thread->title}}</a>
                    </div>
                    
                    <div class="card-body">
                        {!! nl2br(e($thread->content)) !!}
                    </div>    
                </div>

                @foreach($replies as $reply)
                    <div class="card mt-3">
                        <div class="card-header" style="display:flex; align-items:center; gap:10px;">
                            投稿者: {{$reply->user->name}}
                            @if(Auth::user()->id == $reply->user_id)
                                <form action="{{route('reply.destroy', ['thread' => $thread->id, 'reply' => $reply->id])}}" method="post">
                                    <input type="hidden" name="page" value="{{request()->input('page')}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('このコメントを削除しますか？');">削除</button>
                                </form>
                            @endif
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($reply->content)) !!}
                        </div>    
                    </div>
                @endforeach
                {!! $replies->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection
