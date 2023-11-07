@extends('master')

@section('content')

  <div class="container">
    <div class="row mt-5">
        <div class="col-6 offset-3">
            <div class="my-3">
                <a href="{{{route('post#home')}}}" class="text-decoration-none text-black"><i class="fa-solid fa-arrow-left-long"></i> back</a>
            </div>
            <h3>{{ $post->title}}</h3>

            <div class="">
                @if ($post->image == null)
                <img src="{{asset('404.jpg')}}" class="img-thumbnail my-3 shadow-sm">
                @else
                <img src="{{asset('storage/'.$post->image)}}" class="img-thumbnail">
                @endif
            </div>

            <p class="text-muted shadow-sm"> {{ $post->description}}</p>
            <p class="text-muted shadow-sm"> {{ $post->quote}}</p>
            <i class="fa-solid fa-clock"></i> {{$post->created_at->format("n:iA/ d/m  ")}}
        </div>
    </div>
    <div class="row my-3">
        <div class="col-3 offset-8">
           <a href="{{route ('post#editPage',$post['id'])}}">
            <button type="submit" class="btn btn-black btn-outline-dark">Edit</button>
           </a>
        </div>
    </div>
  </div>


@endsection
