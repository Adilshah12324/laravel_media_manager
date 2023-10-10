<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


{{--start modal--}}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('store.folder')}}" method="POST">
                    @csrf
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="name" placeholder="Enter Folder Name">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 ml-2">Create</button>
                </form>
            </div>

        </div>
    </div>
</div>
{{--end modal--}}

<h2>Manage Folders</h2>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($folders as $folder)
        <tr>
            <th>{{$folder->id}}</th>
            <td>{{$folder->name}}</td>
            <td>

                <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-{{ $folder->id }}"><i class="fas fa-eye"></i> View</a>
                <a href="{{route('edit.folder',$folder->id)}}" class="btn btn-success btn-sm" > <i class="fas fa-edit"></i> Edit</a>
                <a href="{{route('delete.folder',$folder->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
            </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg-{{ $folder->id }}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Files Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="bg-light p-3">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <strong class="text-dark">Files:</strong>
                                    <ul class="list-group">
                                    @foreach ($folder->files as $image )
                                            <li class="list-group-item">
                                                <img src="{{ asset('storage/'.$image->path) }}" width="100px" height="100px" alt="File">
                                                <form action="{{route('delete.file',$image->id)}}">
                                                    <input type="hidden" name="folderName" value="{{$folder->name}}">
                                                    <button type="submit">Delete</button>
                                                </form>
{{--                                                <a href="{{route('delete.file',$folder->name,$image->id)}}">Delete--}}
{{--                                                </a>--}}
                                            </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    </tbody>
</table>
</body>
</html>
