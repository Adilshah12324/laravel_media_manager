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
                    {{-- <pre>{{$folders->user_id}}</pre> --}}
                    @if($folders)
                        @foreach($folders as $folder)
                            <a class="dropdown-item" href="{{route('create.file',$folder->name)}}">{{$folder->name}}</a>
                        @endforeach
                    @else
                        <a class="dropdown-item" href="#">No Folder Found</a>
                    @endif
                </div>
            </div>
            <a class="btn btn-info float-right" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </ul>
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
