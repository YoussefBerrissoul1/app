<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">Nestlé Shop</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                @if(Auth::user()->avatar)
                    <img class="rounded-circle" src="{{ asset(Auth::user()->avatar) }}" alt="" style="width: 40px; height: 40px;" onerror="this.src='{{ asset('storage/avatars/user.jpg') }}';">
                @else
                    <img class="rounded-circle" alt="user-profile" src="{{ asset('storage/avatars/user.jpg') }}" style="width: 40px; height: 40px;" onerror="this.src='{{ asset('img/OIP.png') }}';">
                @endif
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ url('/' . Auth::user()->role . '/dashbord') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Tableau de bord</a>
            <!-- Start Commande layout -->
            <div class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-bag-shopping me-2"></i>Les Commandes</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('Commond.index') }}" class="dropdown-item">Toutes les commandes</a>
                    <a href="{{ route('Commond.livree') }}" class="dropdown-item">Commandes Livrées</a>
                    <a href="{{ route('Commond.softDelet') }}" class="dropdown-item">Archive des Commandes</a>
                </div>
            </div>
            <!-- End Orders layout -->

            <!-- Start Products layout -->
            <div class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-sharp fa-solid fa-box-open me-2"></i>Les Produits</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('Produits.index') }}" class="dropdown-item">Liste des Produits</a>
                    <a href="{{ route('Produits.softDelet') }}" class="dropdown-item">Produits Supprimés</a>
                </div>
            </div>
            <!-- End Products layout -->

            <!-- Start Clients layout -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-sharp fa-solid fa-user-group me-2"></i>Clients</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('admin.list') }}" class="dropdown-item">Liste des Clients</a>
                    <a href="{{ route('admin.listnoirC') }}" class="dropdown-item">Liste Noire des Clients</a>
                </div>
            </div>
            <!-- End Clients layout -->

            <!-- Start Comptes layout -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-users me-2"></i>Les Comptes</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('comptes.index') }}" class="dropdown-item">Liste des comptes</a>
                    <a href="{{ route('comptes.listnoire') }}" class="dropdown-item">Liste Noire</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-comment me-2"></i>Les Messages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('admin.toutmessage') }}" class="dropdown-item">Liste des Messages</a>
                </div>
            </div>
            <!-- End Comptes layout -->
        </div>
    </nav>
</div>
<!-- Sidebar End -->