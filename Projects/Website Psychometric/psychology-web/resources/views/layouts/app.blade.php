<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Quiz App')</title>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-lBISJVJ49zh34fnUuAaSAyuYzQ2ioGvhm4As4Z1JFde0kVpaC1FFWD3f9adpZrdD" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/css/themes/bootstrap/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-72sGGfjIx6qT6nqLY5JXJdwHV+8GR6BXqIJMnei1+xNtrRVP9GM/vFJ3+9345bt/"
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
</head>

<body class="bg-light">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right d-flex flex-column" id="sidebar-wrapper" style="min-height: 100vh">
            <div class="sidebar-heading text-center py-4 fs-4 text-white border-bottom">
                Quiz App
            </div>
            <div class="list-group list-group-flush flex-grow-1">
                <a href="{{ url('/') }}"
                    class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
                    <i class="fas fa-home me-3"></i> Home
                </a>
                @if (session('role') == 'admin')
                    <a href="{{ url('/admin') }}"
                        class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
                        <i class="fas fa-user-shield me-3"></i> Admin
                    </a>
                @endif
                <a href="{{ url('/questions') }}"
                    class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
                    <i class="fas fa-pencil-alt me-3"></i> Take Quiz
                </a>
                <a href="{{ url('/result') }}"
                    class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
                    <i class="fas fa-chart-line me-3"></i> Results
                </a>
            </div>


            <div class="mt-auto p-3 text-center border-top">
                @if (session('logged_in'))
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ url('/profile') }}" class="text-white me-3">
                            <i class="fas fa-user-circle me-1"></i>Profile
                        </a>
                        <a href="{{ url('/logout') }}" class="text-white">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="text-white me-2">Login</a>
                    <span class="text-white">|</span>
                    <a href="{{ url('/signup') }}" class="text-white ms-2">Signup</a>
                @endif
            </div>

        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="flex-grow-1">
            <div class="container-fluid content-container py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-i+Yu7CmJG/p8FA6Avyg4ZheFvxNjJQ5taj5ArZf94yQt1lWZiVwkXyPrgE/QqbJi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/js/coreui.bundle.min.js"
        integrity="sha384-yoEOGIfJg9mO8eOS9dgSYBXwb2hCCE+AMiJYavhAofzm8AoyVE241kjON695K1v5" crossorigin="anonymous">
    </script>
</body>

</html>
