<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href=" {{ url('/') }}">
            <img alt="Image placeholder" src="{{ asset('img/brand/dark.svg') }}" id="navbar-logo">
        </a>
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mt-4 mt-lg-0 ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href=" {{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" title="List of all available post">
                        Posts
                    </a>
                </li>
                
                @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                @else

                    <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Pages</a>
                        <div class="dropdown-menu dropdown-menu-single">
                            <a href="{{ route('post.all') }}" class="dropdown-item">My Posts</a>
                            <a href="{{ route('post.create') }}" class="dropdown-item">Add Post</a>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <a class="navbar-btn btn btn-sm btn-primary d-none d-lg-inline-block ml-3" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('LOGOUT') }}
                            ({{ Auth::user()->name }})
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    
                @endif
            </ul>
            
        </div>
    </div>
</nav>