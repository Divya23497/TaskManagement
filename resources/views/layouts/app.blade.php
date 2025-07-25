<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        @yield('title', 'Task Management System')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> --}}

<body>

    {{-- Header --}}
    @php
        $currentRoute = Route::currentRouteName();
        $showHeader = in_array($currentRoute, ['home', 'login', 'registration']);
    @endphp


    @if ($showHeader)
        @include('partials.header1')
    @endif

    @php
        $currentRoute = Route::currentRouteName();
        $showHeaderUser = !in_array($currentRoute, ['home', 'login', 'registration']);
    @endphp

    @if ($showHeaderUser)
        @include('partials.header')
    @endif

    @php
        $currentRoute = Route::currentRouteName();
        $showSidebar = !in_array($currentRoute, ['home', 'login', 'registration']);
    @endphp

    @if ($showSidebar)
        @include('partials.sidebar')
    @endif

    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bootstrap JS (Optional) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap 4 JS (required for modal) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
