@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Add Discussion</div>

    <div class="card-body">

        <form action="{{ route('discussions.store') }}" method="post">
        @csrf
          
        <div class="form-group">

            <label for="title">Title</label>
            <input type="text" name="title" class="form-control
            @error('title') is-invalid @enderror">

            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">

            <label for="content">Content</label>
            <input id="content" type="hidden" name="content">
            <trix-editor input="content" class="form-control
            @error('content') is-invalid @enderror"></trix-editor>

            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
        
        <div class="form-group">

            <label for="channel">Channel</label>
            <select name="channel" id="channel" class="form-control">

                @foreach($channels as $channel)

                <option value="{{ $channel->id }}">
                    {{ $channel->name }}
                </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">create Discussion</button>
        </div>
        
        </form>

    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">   
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
