<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Marmazya Users - {{ $title ?? 'Dashboard' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-200 min-h-screen flex flex-col">
  <!-- Header Navbar -->
  <header class="w-full bg-gray-800 shadow-lg p-4 flex justify-between items-center">
    <a href="{{ route('home') }}"><h2 class="text-2xl font-bold">Marmazya Users</h2></a>
    <nav class="space-x-6 hidden md:flex">
    @auth
    Welcome, {{ auth()->user()->name }} | &nbsp;
        <a href="{{ route('home') }}" class="hover:text-gray-400">Home</a>
        <a href="{{ route('users.show', auth()->user()) }}" class="hover:text-gray-400">View Profile</a>
        <a href="{{ route('user.edit') }}" class="hover:text-gray-400">Edit Profile</a>
        @can('admin-role')
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-400">Admin Dashboard</a>
        @endcan
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="hover:text-gray-400">Logout</button>
        </form>
    @endauth
    @guest
        <a href="{{ route('login') }}" class="hover:text-gray-400">Login</a>
        <a href="{{ route('register') }}" class="hover:text-gray-400">Register</a>
    @endguest
    </nav>
  </header>

  <!-- Main Content -->
    <main class="flex-grow p-8">
      <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">{{ $title ?? 'Dashboard' }}</h1>
        {{ $actions ?? '' }}
      </header>
      <x-admin.flash.flash-message />
        {{ $slot }}
    </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-400 py-4 text-center mt-6">
    <p>&copy; {{ date('Y') }} Marmazya Dashboard. All Rights Reserved.</p>
  </footer>
</body>
</html>
