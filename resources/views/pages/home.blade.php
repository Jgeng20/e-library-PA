<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $app_title }}</title>
    <link href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-blue shadow-sm">
            <div class="container">
                <a href="/" class="brand-link">
                    <img src="{{ $app_logo ? asset('storage/' . $app_logo) : asset('https://placehold.co/400x600') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-white shadow-sm" style="opacity: .8">
                    <span class="brand-text font-weight-black text-dark">{{ $app_title }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="btn btn-custom btn-lg mr-3" href="https://wa.me/6288801807394">Contact</a>
                        </li>
                        <li class="nav-item">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-custom btn-lg">Login</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="btn btn-custom btn-lg">Masuk</a>
                            @endguest
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <!-- Jumbotron -->
                    <div class="jumbotron jumbotron-fluid text-center text-white bg-dark"
                        style="background-image: url('{{ $app_logo ? asset('storage/' . $app_logo) : asset('https://placehold.co/1200x600') }}'); background-size: cover; background-position: center;">
                        <div class="container py-5">
                            <h1 class="display-4 font-weight-bold">{{ $app_title }}</h1>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Masuk ke Dashboard</a>
                            @endguest
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8 text-center">
                            <p class="lead font-weight-light">{{ $app_description }}</p>
                            <div class="row justify-content-center mt-5" >
                                
                                <div class="col-lg col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="small-box bg-blue text-white h-100 d-flex justify-content-center align-items-center">
                                        <div class="inner text-center">
                                            <h3>{{ $totalBooks }}</h3>
                                            <p class="font-weight-bold">Anggota</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="small-box bg-blue text-white h-100 d-flex justify-content-center align-items-center">
                                        <div class="inner text-center">
                                            <h3>{{ $totalMembers }}</h3>
                                            <p class="font-weight-bold">Anggota</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <footer class="text-center py-4 bg-dark text-white">
                        <div class="mb-3">
                            <a href="https://facebook.com/{{ $facebook_link }}" target="_blank"
                                class="text-white mr-3"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="https://instagram.com/{{ $instagram_link }}" target="_blank"
                                class="text-white mr-3"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="https://twitter.com/{{ $twitter_link }}" target="_blank" class="text-white"><i
                                    class="fab fa-twitter fa-2x"></i></a>
                        </div>
                        <div class="mt-3">
                            <p>Email: {{ $app_email }}</p>
                            <p>Telepon: {{ $app_phone }}</p>
                        </div>
                    </footer>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>