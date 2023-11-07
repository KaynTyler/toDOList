@extends('master')


@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-5 ">
                <div class="p-3">
                    @if (session('insertSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('insertSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('updateSuccess'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                    <form action="{{ route('post#create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- @if ($errors->any()) @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach @endif --}}
                        <div class="text-group mb-3">
                            <label for="">Post Title</label>
                            <input type="text" name="postTitle"
                                class="form-control @error('postTitle')is-invalid @enderror " value="{{ old('postTitle') }}"
                                placeholder="Enter Post Title...">
                            @error('postTitle')
                                <div class="invalid-feeback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="text-group mb-3">
                            <label for="">Post Description</label>
                            <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror" cols="30"
                                rows="10" placeholder="Enter Post Description...">{{ old('postDescription') }}</textarea>
                            @error('postDescription')
                                <div class="invalid-feeback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                       <div class="text-group mb-3">
                            <label for="">Post Quote</label>
                             <input type="text" name="postQuote" class="form-control @error('postQuote') is-invalid @enderror " value="{{ old('postQuote') }}"
                            placeholder="Enter Post Quote..">
                              @error('postQuote')
                                <div class="invalid-feeback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="text-group mb-3">
                            <label for="">Post Image</label>
                             <input type="file" name="postImage" class="form-control @error('postImage') is-invalid @enderror" value="{{ old('postImage') }}"
                            placeholder="Enter Post Qoute..">
                              @error('postImage')
                                <div class="invalid-feeback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Create" class="btn btn-outline-danger btn-outline-dark">
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-7 ">
                <h3>
                    <div class="row">
                        <div class="col-5">Posts - {{ $posts->total() }}</div>
                        <div class="col-5 offset-2 ">
                           <form action="{{ route('post#createPage')}}" method="get">
                             <div class="row">
                                <input type="text" name="searchKey" value="{{request("searchKey")}}" id="" class="form-control col" placeholder="Search">
                                <button class="btn btn-outline-dark col-3" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                           </form>

                        </div>
                    </div>
                </h3>
                <div class="data-container">
                   @if (count($posts) != 0)
                   @foreach ($posts as $item)
                    <div class="post p-3 shadow-sm mb-3">
                        <div class="row">
                            <h5 class="col-7">{{ $item['title'] }}</h5>
                            <h5 class="col-4 offset-1"><i class="fa-solid fa-clock"></i>  {{ $item->created_at->format('n:iA/ d/m ') }}</h5>
                        </div>

                        <p class="text-muted">{{ Str::words($item['description'], 30, '...') }}</p>
                        <p class="text-muted">{{ Str::words($item['quote'], 30, '...') }}</p>



                        <div class="text-end ">
                            <a href="{{ route('post#delete', $item['id']) }}">
                                <button class="btn btn-white btn-outline-danger"><i class="fa-solid fa-trash"></i>
                                    Delete</button>
                            </a>
                            {{-- <form action="{{route('post#delete',$item['id'])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-white btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form> --}}
                            <a href="{{ route('post#updatePage', $item['id']) }}">
                                <button class="btn btn-white btn-outline-primary"><i
                                        class="fa-solid fa-circle-info"></i></i> More</button>
                            </a>
                        </div>
                    </div>
                   @endforeach
                   @else
                     <h3 class="text-danger text-center mt-2">There  is no post...</h3>
                   @endif
                </div>
                {{ $posts->appends(request()->query())->links('') }}
            </div>

        </div>
    </div>
@endsection
