@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My Profile</div>

    <div class="card-body">
        <form action="{{route('users.update-profile')}}" method="POST">
            @csrf
            @method('PUT')
             <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" id="title" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('title', $user->name)}}"/>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
             </div>
              <div class="form-group">
                   <label for="about">About Me</label>
                   <textarea name="about" id="" cols="5" rows="5" class="form-control @error('about') is-invalid @enderror">{{ old('about', $user->about) }}</textarea>
                    @error('about')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
             </div>
            <button class="btn btn-success btn-sm" type="submit">Update Profile</button>
        </form>
    </div>
</div>
@endsection
