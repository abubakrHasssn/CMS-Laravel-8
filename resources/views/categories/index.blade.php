@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->posts->count()}}</td>
                            <td>
                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" onclick="handelDelete({{$category->id}})" data-toggle="modal" data-target="#DeleteModal">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center"><h1>No Categories Yet.</h1></div>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <form action="" method="post" id="deleteCategoryForm">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteModalLabel">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        function handelDelete(id) {
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/'+id
        }
    </script>
@endsection
