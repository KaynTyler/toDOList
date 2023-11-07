@extends('master')

@section('content')

  <div class="container">
    <div class="row mt-5">
        <div class="col-6 offset-3">
            <div class="my-3">
                <a href="{{route('post#updatePage',$post['id'])}}" class="text-decoration-none text-black"><i class="fa-solid fa-arrow-left-long"></i> back</a>
            </div>
            <form action="{{route('post#update')}}" method="POST" enctype="multipart/form-data">
                @csrf

            <label  class="">Post Title</label>
            <input type="hidden" name="postId" value="{{$post['id']}}">
            <input class="form-control @error ('postTitle') is-invalid  @enderror my-3" type="text" name="postTitle"  value="{{old('postTitle',$post['title'])}}" placeholder="Enter Post Title" >
             @error('postTitle')
             <div class="invalid-feedback mb-3">
                {{$message}}
             </div>
             @enderror

             <label for="">Image</label>
             <div class="">
                @if ($post['image'] == null)
                <img src="{{asset('404.jpg')}}"  class="img-thumbnail my-3 shadow-sm">
                @else
                <img src="{{asset('storage/'.$post['image'])}}" class="img-thumbnail">
                @endif
            </div>
            <input type="file" name="postImage" class="form-control @error('postImage') is-invalid @enderror" value="{{ old('postImage') }}"
            placeholder="Enter Post Qoute..">
              @error('postImage')
                <div class="invalid-feeback text-danger">
                    {{ $message }}
                </div>
            @enderror

            <input class="form-control  my-3" type="text" name="postTitle"  value="{{old('postTitle',$post['title'])}}" placeholder="Enter Post Title" >

            <label >Post Description</label>
            <textarea class="form-control  @error ('postDescription') is-invalid  @enderror my-3 "  name="postDescription"  cols="30" rows="10" placeholder="Enter Post Description" >
                {{old('postDescription',$post['description'])}}</textarea>
                @error('postDescription')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
                @enderror

            <label >Post Quote</label>
            <textarea class="form-control  @error ('postQuote') is-invalid  @enderror my-3 "  name="postQuote"  cols="30" rows="10" placeholder="Enter Post Quote" >
                    {{old('postQuote',$post['quote'])}}</textarea>
                    @error('postQuote')
                    <div class="invalid-feedback">
                       {{$message}}
                    </div>
                @enderror

                  <input type="submit" value="Update" class="btn btn-black btn-outline-dark float-end">
            </form>
        </div>
    </div>



@endsection
