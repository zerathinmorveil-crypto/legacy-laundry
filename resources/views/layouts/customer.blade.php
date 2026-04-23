<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laundry') — Customer</title>

    {{-- Bootstrap & FontAwesome --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body { background-color: #f4f6f9; }

        .navbar-brand { font-weight: 700; letter-spacing: 1px; }

        .border-left-primary  { border-left: 4px solid #007bff !important; }
        .border-left-success  { border-left: 4px solid #28a745 !important; }
        .border-left-warning  { border-left: 4px solid #ffc107 !important; }

        .opacity-50 { opacity: 0.5; }
        .opacity-75 { opacity: 0.75; }

        footer { font-size: 0.85rem; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('customer.home') }}">
            <i class="fas fa-tshirt mr-2"></i>MyLaundry
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCustomer">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navCustomer">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->routeIs('customer.home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customer.home') }}">
                        <i class="fas fa-home mr-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.transactions') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customer.transactions') }}">
                        <i class="fas fa-receipt mr-1"></i>Transaksi Saya
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customer.profile') }}">
                        <i class="fas fa-user mr-1"></i>Profil
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fas fa-user-circle mr-1"></i>{{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('customer.profile') }}">
                            <i class="fas fa-user mr-2"></i>Profil Saya
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
</div>

{{-- Content --}}
<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer class="text-center text-muted py-4 mt-5 border-top">
    <div class="container">
        <i class="fas fa-tshirt mr-1"></i> &copy; {{ date('Y') }} MyLaundry — All Rights Reserved
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')
</body>
</html>