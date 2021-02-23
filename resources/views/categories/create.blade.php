@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            @isset($category)
            Edit Category
            @else  
            Create category
            @endisset       
        </div>
        <div class="card-body">
            <form action="{{isset($category)?route('categories.update',$category->id):route('categories.store')}}" method="POST">
                @if (isset($category))
                   @method('PUT') 
                @endif
                @csrf
                <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ isset($category)?old('name', $category->name):old('name')}}"/>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <button class="btn btn-success">
                    @isset($category)
                    Update Category
                    @else  
                    Add category
                    @endisset       
                   </button>
                </div>
            </form>
        </div>
    </div>
@endsection