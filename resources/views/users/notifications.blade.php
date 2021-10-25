@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">

        <ul class="list-group">

            @foreach($notifications as $notification)

            <li class="list-group-item">

                @if($notification->type == 'App\Notifications\NewReplyAdded')

                    A New Reply Was Added to Your Discussion

                    <strong>{{ $notification->data['discussion']['title'] }}</strong>

                    <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="float-right btn btn-info btn-sm">
                        View Discussion
                    </a>

                @endif

                @if($notification->type == 'App\Notifications\MarkedAsBestReply')

                    Your Reply to Discussion <strong>{{ $notification->data['discussion']['title'] }}</strong>

                    Was Marked As Best Reply

                    <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="float-right btn btn-info btn-sm">
                        View Discussion
                    </a>

                @endif

            </li>

            @endforeach

        </ul>   

    </div>
</div>
@endsection
