@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            @isset($tag)
            Edit Tag
            @else  
            Create Tag
            @endisset       
        </div>
        <div class="card-body">
            <form action="{{isset($tag)?route('tags.update',$tag->id):route('tags.store')}}" method="POST">
                @if (isset($tag))
                   @method('PUT') 
                @endif
                @csrf
                <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ isset($tag)?old('name', $tag->name):old('name')}}"/>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <button class="btn btn-success">
                    @isset($tag)
                    Update Tag
                    @else  
                    Add Tag
                    @endisset       
                   </button>
                </div>
            </form>
        </div>
    </div>
@endsection