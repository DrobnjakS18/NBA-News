<!DOCTYPE HTML>
<html lang="{{ \App::getLocale() }}">
@include('admin.partials.head')
<body id="page-top">
@include('admin.partials.nav')
@include('admin.partials.side_bar')

        @yield('content')

@include('admin.partials.footer')
@include('admin.partials.script')
@yield('scripts')

</body>

</html>
