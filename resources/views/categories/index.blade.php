@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <table class="table">
            <thead>
                <th>Name</th>
                <th>Posts Count</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($categories as $category )
                    <tr>
                        <td>
                        {{$category->name}}
                        </td>
                        <td>
                        {{$category->posts->count()}}
                        </td>
                        <td>
                         <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
                         <button onclick="HandleDelete({{$category->id}})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>

            <div class="modal" id="deleteModal" tabindex="-1">
                <div class="modal-dialog">
                    <form action="" method="POST" id="deleteCategoryForm">
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
          var form = document.getElementById('deleteCategoryForm');
          form.action = '/categories/'+id; 
          $('#deleteModal').modal('show')
      }
    </script>
    