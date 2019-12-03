<!DOCTYPE HTML>
<html lang="{{ \App::getLocale() }}">
@include('partials.head')
<body>
@include('partials.nav')
@include('partials.side_nav')

@yield('content')

@include('partials.footer')

@include('partials.script')
@yield('scripts')

</body>
</html>
