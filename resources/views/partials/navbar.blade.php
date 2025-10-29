<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <img src="{{ asset('images/my-logo.png') }}" alt="Logo" style="height: 40px;">

        @if( Auth::check() )
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('biblioteca') && ! Request::is('biblioteca/create')? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/biblioteca')}}">
                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                            Biblioteca
                        </a>
                    </li>

                    @if (Request::is('biblioteca'))
                    <li class="nav-item dropdown">
                    <button class="btn btn-link nav-link dropdown-toggle" type="button" id="userDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorías
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="userDropdown" style="min-width: 250px;">
                        <form action="{{ route('biblioteca.biblioteca') }}" method="get">
                        @foreach($categorias as $categoria)
                            <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="categorias[]"
                                value="{{ $categoria->id }}"
                                id="cat-{{ $categoria->id }}"
                                {{ in_array($categoria->id, request()->get('categorias', [])) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="cat-{{ $categoria->id }}">
                                {{ $categoria->nombre }}
                            </label>
                            </div>
                        @endforeach

                        <div class="mt-2 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
                        </div>
                        </form>
                    </div>
                    </li>
                    @endif

                    @if (Auth::user()->email == 'admin@admin.es')
                    <li class="nav-item dropdown {{ Request::is('gestion/*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="gestionDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Gestión
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="gestionDropdown">
                            <li><a class="dropdown-item" href="{{ url('gestion/libro') }}">Libros</a></li>
                            <li><a class="dropdown-item" href="{{ url('gestion/categoria') }}">Categorías</a></li>
                            <li><a class="dropdown-item" href="{{ url('gestion/user') }}">Usuarios</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                    @csrf
                                    <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>    
</nav>
