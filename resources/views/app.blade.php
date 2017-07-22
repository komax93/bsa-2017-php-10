<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials._header')
</head>
<body >
    @include('partials._navbar')

    <div class="container theme-showcase" role="main">

        @yield('content')

    </div>

    @include('partials._scripts')
</body>
</html>
