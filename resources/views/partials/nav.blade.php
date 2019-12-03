<div class="h-top" id="home">
    <div class="top-header">
        <ul class="cl-effect-16 top-nag">
            @if(!session('user'))
            <li><a href="{{asset('/registration')}}" data-hover="Registration">Registration</a></li>
            <li><a href="{{route('login.create')}}" data-hover="Login">Login</a></li>
            @else
                <li><a href="{{asset('/logout')}}" data-hover="Logout">Logout</a></li>
                <li><a href="{{route('profile',['username'=>session('user')->username])}}" data-hover="Profile">Profile</a></li>
                @if(session('user')->name == 'admin')
                <li><a href="{{route('users.index')}}" data-hover="Logout">Admin</a></li>
                    @endif
                @endif
        </ul>
        <div class="search-box">
            <div class="b-search">
                <form action="{{asset('/search')}}" method="get">
                    <input type="text"  name="search_value"/>
                    <input type="submit" name="search" value=""/>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
