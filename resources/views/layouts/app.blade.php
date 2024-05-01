<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3s4Wz6iJgD/+ub2oU" crossorigin="anonymous"> --}}

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('assets\css\demo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <div id="app">

        <nav id="sidebar">
            <header>
                <div class="image-text">
                    <div class="text header-text">
                        <h3 class="name">Fratij Spares</h3>
                        <span class="profession">Authorised TUKTUK Spareparts Dealer</span>
                    </div>
                </div>
            </header>
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="/home" class="active-link">
                        <i class='bx bxs-home-alt-2 icon'></i>
                        <span class="text nav-text">Home</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/products" class="active-link">
                        <i class='bx bxs-package icon'></i>
                        <span class="text nav-text">Products</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/suppliers" class="active-link">
                        <i class='bx bx-import icon'></i>
                        <span class="text nav-text">Suppliers</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/customers" class="active-link">
                        <i class='bx bxs-user-pin icon'></i>
                        <span class="text nav-text">Customers</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/sales" class="active-link">
                        <i class='bx bx-money-withdraw icon'></i>
                        <span class="text nav-text">Sales</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/orders" class="active-link">
                        <i class='bx bxs-cart-alt icon'></i>
                        <span class="text nav-text">Orders</span>
                    </a>
                </li>
            </ul>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="" class="active-link">
                        <i class='bx bxs-face-mask icon'></i>
                        <span class="text nav-text">Profile</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/analytics" class="active-link">
                        <i class='bx bxs-pie-chart-alt-2 icon'></i>
                        <span class="text nav-text">Analytics</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="" class="active-link">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </nav>

    </div>
    <main class="py-4">

        @yield('content')
    </main>
    </div>
</body>

</html>
