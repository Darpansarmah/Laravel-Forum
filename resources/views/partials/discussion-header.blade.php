<div class="card-header">

    <div class="d-flex justify-content-between">

        <div>
            <img height="40px" width="40px" style="border-radius: 50%" src="{{ Gravatar::src($discussion->user->email) }}" alt="">
            <span class="ml-2 font-weight-bold">{{ $discussion->user->name}}</span> 
        </div>

        

        <div>

            @auth

            <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>

            @else

            <a href="{{ route('login') }}" class="btn btn-info">
                Sign in to view post
            </a>
    
            @endauth            

        </div>

       

    </div>

</div>