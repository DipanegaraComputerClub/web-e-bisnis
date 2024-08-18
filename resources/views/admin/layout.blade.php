<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2">
            <!-- Logo -->
            <a href="#" class="text-white flex items-center space-x-2 px-4">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                <span class="text-2xl font-extrabold">Admin</span>
            </a>

            <!-- Navigation -->
            <nav>
                <a href="{{route('ahome')}}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Dashboard
                </a>
                <a href="{{route('aproduk')}}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Produk
                </a>
                <a href="{{route('auser')}}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    User
                </a>
                <a href="{{route('apesanan')}}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Pesanan
                </a>
                <a href="{{route('akonfirmasi')}}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Konfirmasi
                </a>
                <a href="{{route('logout')}}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Logout
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        @yield('content')
    </div>
</body>

</html>
