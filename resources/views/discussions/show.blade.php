@extends('layouts.app')

@section('content')

    <div class="card">

        @include('partials.discussion-header')

        <div class="card-body">

            <div class="text-center">
                <strong>{!! $discussion->title !!}</strong>
            </div> 
            
            <hr>

            {!! $discussion->content !!}

            @if($discussion->bestReply)
                <div class="card bg-success" style="color: #fff">

                    <div class="card-header">
                        <div class="d-flex justify-content-between">

                            <div>
                                <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::src($discussion->bestReply->user->email) }}" alt="">
                                <strong class="ml-2">{{ $discussion->bestReply->user->name }}</strong>
                            </div>

                            <div>
                                <strong>BEST REPLY</strong>
                            </div>

                        </div>
                        
                    </div>

                    <div class="card-body">
                        {!! $discussion->bestReply->content !!} 
                    </div>
                                       
                </div>
            @endif

        </div>

    </div>

    @foreach($discussion->replies()->paginate(3) as $reply)

    <div class="card my-5">
        
        <div class="card-header">
            <div class="d-flex justify-content-between">

                <div>
                    <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::src($reply->user->email) }}" alt="">
                    <span>{{ $reply->user->name }}</span>
                </div>

                <div>
                    @if(auth()->user()->id == $discussion->user_id)
                    
                    <form action="{{ route('discussions.reply', ['discussion'=>$discussion->slug, 'reply'=>$reply->id]) }}" method="post">
                        @csrf
    
                        <button type="submit" class="btn btn-secondary btn-sm">Mark as Best Reply</button>
                    </form>
                    
                    @endif
                </div>

            </div>
        </div>
    
    <div class="card-body">
        {!! $reply->content !!}
    </div>

</div>

    @endforeach

    {{ $discussion->replies()->paginate(3)->links() }}

    <div class="card my-5">

        <div class="card-header">
            Add a Reply
        </div>

        <div class="card-body">

        @auth

        <form action="{{ route('replies.store', $discussion->slug) }}" method="post">
        @csrf
    
                <div class="form-group">
    
                    <input id="reply" type="hidden" name="reply">
                    <trix-editor input="reply" class="form-control
                    @error('reply') is-invalid @enderror"></trix-editor>
        
                    @error('reply')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        
                </div>
    
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Add Reply</button>
                </div>
    
            </form>

        @else

        <a href="{{ route('login') }}" class="btn btn-info">
            Sign in to Add a Reply
        </a>
            
        @endauth

    </div>

    </div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">   
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
