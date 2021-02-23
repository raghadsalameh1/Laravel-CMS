@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            @isset($post)
            Edit post
            @else  
            Create post
            @endisset       
        </div>
        <div class="card-body">
            <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @if (isset($post))
                   @method('PUT') 
                @endif
                @csrf
                <div class="form-group">
                   <label for="title">Title</label>
                   <input type="text" id="title" class="form-control  @error('title') is-invalid @enderror" name="title" value="{{ isset($post)?old('title', $post->title):old('title')}}"/>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <label for="description">Description</label>
                   <textarea type="text" id="description" class="form-control  @error('description') is-invalid @enderror" name="description" cols="5" rows="5">{{ isset($post)?old('description', $post->description):old('description')}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <label for="content">Content</label>
                   <input id="content" type="hidden" name="content" value="{{ isset($post)?old('content', $post->content):old('content')}}">
                   <trix-editor input="content"></trix-editor>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <label for="published_at">Published At</label>
                   <input type="text" id="published_at" class="form-control  @error('published_at') is-invalid @enderror" name="published_at" value="{{ isset($post)?old('published_at', $post->published_at):old('published_at')}}"/>
                    @error('published_at')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <label for="image">Image</label>
                   <input type="file" id="image" class="form-control  @error('image') is-invalid @enderror" name="image" value="{{ isset($post)?old('image', $post->image):old('image')}}"/>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if (isset($post))
                       <img src="{{ asset('storage/'.$post->image)}}" alt="Image" style="width:100%"> 
                    @endif
                </div>
                <div class="form-group">
                   <label for="category">Category</label>
                   <select name="category" id="category" class="form-control  @error('category') is-invalid @enderror">
                   @foreach ($categories as $category)
                       <option value="{{$category->id}}" 
                       @if (@isset($post))
                           @if ($category->id==$post->category_id)
                           selected
                           @endif
                       @endif>
                        {{$category->name}}
                       </option>
                   @endforeach              
                   </select>
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                 <div class="form-group">
                   <label for="tags">Tags</label>
                   <select name="tags[]" id="tags" class="form-control tag-selector @error('tags') is-invalid @enderror" multiple>
                   @foreach ($tags as $tag)
                       <option value="{{$tag->id}}" 
                       @if (@isset($post))
                           @if ($post->hasTag($tag->id))
                           selected
                           @endif
                       @endif>
                        {{$tag->name}}
                       </option>
                   @endforeach              
                   </select>
                    @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <button class="btn btn-success">
                    @isset($post)
                    Update Post
                    @else  
                    Add Post
                    @endisset       
                   </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://lib.arvancloud.com/ar/trix/1.2.0/trix.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> 
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
    flatpickr('#published_at',{ enableTime:true, enableSeconds:true})
    $(document).ready(function() {
        $('.tag-selector').select2();
    });
  </script> 
@endsection

@section('css')
  <link href="https://lib.arvancloud.com/ar/trix/1.2.0/trix.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection 