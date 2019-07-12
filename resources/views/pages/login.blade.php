@extends('layouts.frontEnd')
@section('title')
    Login
@endsection
@section('login')
    @if (session('reg_success'))
        <div class="alert alert-success">
            {{ session('reg_success') }}
        </div>
    @endif
    @if (session('login_error'))
        <div class="alert alert-danger">
            {{ session('login_error') }}
        </div>
    @endif
    <!-- login-page -->
    <div class="login">
        <div class="login-grids">
            <div class="col-md-6 log">
                <h3 class="tittle">Login <i class="glyphicon glyphicon-log-in"></i></h3>
                <p>Welcome, please enter the following to continue.</p>
                <form action="{{asset('/login')}}" method="POST" onsubmit="return Login()">
                    @csrf
                    <h5>User Name:</h5>
                    <input type="text" name="username" id="username">
                    <h5>Password:</h5>
                    <input type="password" name="pass" id="pass">
                    <input type="submit" name="login" id="login" value="Login">

                </form>
                <div class="alert alert-danger" id="log_error"></div>
            </div>
            <div class="col-md-6 login-right">
                <h3 class="tittle">New Registration <i class="glyphicon glyphicon-registration-mark"></i></h3>
                <p>If your not registered click on the link below</p>
                <a href="{{asset('/registration')}}" class="hvr-bounce-to-bottom button">Create An Account</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //login-page -->
    <div class="clearfix"> </div>


@endsection
@section('script')

    @parent
    <script type="text/javascript">

        function Login() {

            var errors_array = [];
            var username = $('#username').val();

            var username_reg = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;

            if (!username_reg.test(username)) {

                errors_array.push('Bad username');
            }

            var pass = $('#pass').val();

            var pass_reg = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/;

            if (!pass_reg.test(pass)) {

                errors_array.push('Bad Password');
            }

            if(errors_array.length > 0){

                var error = '<ul>';
                for (var i in errors_array) {

                    error += "<li>" + errors_array[i] + "</li>";
                }
                error += '</ul>';


                $('#log_error').html(error);
                $('#log_error').show();
                return false;
            }else{

                return true;
            }
        }

    </script>
    @endsection