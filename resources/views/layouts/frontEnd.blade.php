<!DOCTYPE HTML>
<html>
@include('partials.head')
<body>
@include('partials.nav')
@include('partials.side_nav')

@yield('search')
@yield('profile')
@yield('single_post')
@yield('about')
@yield('contact')
@yield('gallery')
@yield('reg')
@yield('login')
@yield('home')

{{--BACKEND--}}
@yield('post_form')
@include('partials.footer')

@include('partials.script')
@yield('scripts')


</body>
</html>
