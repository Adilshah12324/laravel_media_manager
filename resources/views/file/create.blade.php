<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!------ Include the above in your HEAD tag ---------->
<!-- Include Dropzone CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/">Media Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav menu">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="modal" data-target="#exampleModal">Create Folder</a>
            </li>

            <div class="dropdown">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My Folders
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @if($folders)
                        @foreach($folders as $folder)
                            <a class="dropdown-item" href="{{route('create.file',$folder->name)}}">{{$folder->name}}</a>
                        @endforeach
                    @else
                        <a class="dropdown-item" href="#">No Folder Found</a>
                    @endif
                </div>
            </div>
        </ul>
    </div>
</nav>

{{--start session--}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
{{--end session--}}
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
                        {{--                        <label for="inputPassword2" class="sr-only"></label>--}}
                        <input type="text" class="form-control" name="name" placeholder="Enter Folder Name">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 ml-2">Create</button>
                </form>
            </div>

        </div>
    </div>
</div>
{{--end modal--}}



{{--start dropzone--}}

<div class="container-fluid">
    <div class="card">
        <div class="card-header">Upload File Here
            <div class="container">
                <form action="{{route('upload.file')}}" method="post" enctype="multipart/form-data" class="dropzone" id="file-upload">
                    @csrf
                    <input type="hidden" name="folderName" value="{{ request()->segment(3) }}">
                </form>
            </div>
        </div>
    </div>
</div>
{{--end dropzone--}}
<script>
    Dropzone.options.fileUpload = {
        paramName: "file",
        maxFilesize: 2,
        acceptedFiles: ".jpg, .jpeg, .png, .pdf",
        init: function () {
            this.on("success", function (file, response) {
                // Handle success, e.g., show a success message
            });

            this.on("error", function (file, errorMessage) {
                // Handle errors, e.g., display an error message
            });
        },
    };
</script>


