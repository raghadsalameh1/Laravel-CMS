@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
        @if ($posts->count()>0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($posts as $post )
                        <tr>
                            <td><img src="{{ asset('storage/'.$post->image)}}" width="120px" height="60px" alt="image"></td>
                            <td>
                            {{$post->title}}
                            </td>
                            <td>
                            <a href="{{route('categories.edit',$post->category->id)}}">{{$post->category->name}}</a>                            
                            </td>
                            <td>
                            @if (!$post->trashed())
                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a> 
                            @else
                            <form action="{{route('post.restore',$post->id)}}" method="post" style="display: inline">
                              @csrf
                              @method('PUT')
                              <button class="btn btn-info btn-sm" type="submit">Restore</button>
                            </form>
                            @endif  
                            <button onclick="HandleDelete({{$post->id}})" class="btn btn-danger btn-sm">{{$post->trashed()?'Delete':'Trash'}}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <h3 class="text-center"> No posts yet</h3>         
        @endif
            <div class="modal" id="deleteModal" tabindex="-1">
                <div class="modal-dialog">
                    <form action="" method="POST" id="deletePostForm">
                       @method('DELETE')
                       @csrf
                       <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this item?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
      function HandleDelete(id) {
          //console.log('Delete',id);
          var form = document.getElementById('deletePostForm');
          form.action = '/posts/'+id; 
          $('#deleteModal').modal('show')
      }
    </script>
    