<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div style="width: 400px" class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                @foreach($message as $m)
                    <a href="{{ route('admin.toutmessage') }}" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="{{ asset('storage/avatars/user.jpg') }}" alt="" style="width: 40px; height: 40px;" onerror="this.src='{{ asset('img/OIP.png') }}';">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0"><strong>{{ $m->name }}</strong> vous a envoyé un message</h6>
                                <small>{{ $m->created_at->format('d/m/Y h:i:s') }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach

                <hr class="dropdown-divider">
                <a href="{{ route('admin.toutmessage') }}" class="dropdown-item text-center">Voir tous les messages</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notification</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profil mis à jour</h6>
                    <small>il y a 15 minutes</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Nouvel utilisateur ajouté</h6>
                    <small>il y a 15 minutes</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Mot de passe changé</h6>
                    <small>il y a 15 minutes</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">Voir toutes les notifications</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if(Auth::user()->avatar)
                    <img class="rounded-circle me-lg-2" src="{{ asset(Auth::user()->avatar) }}" alt="" style="width: 40px; height: 40px;" onerror="this.src='{{ asset('storage/avatars/user.jpg') }}';">
                @else
                    <img class="rounded-circle me-lg-2" src="{{ asset('storage/avatars/user.jpg') }}" alt="" style="width: 40px; height: 40px;" onerror="this.src='{{ asset('img/OIP.png') }}';">
                @endif
                <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ Auth::user()->email }}</a>
                <a href="{{ route(Auth::user()->role . '.profile') }}" class="dropdown-item">Mon Profil</a>
                <a href="#" class="dropdown-item">Paramètres</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Se déconnecter') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
<style>
    .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 50%;
        background-color: red;
        color: white;
        font-size: 12px;
    }

    .nav-link {
        position: relative;
    }

    .navbar-nav .nav-item .nav-link .badge {
        position: absolute;
        top: 0;
        right: -10px;
        padding: 5px 10px;
        border-radius: 50%;
        background-color: red;
        color: white;
        font-size: 12px;
    }
</style>