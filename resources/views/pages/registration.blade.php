@extends('layouts.frontEnd')
@section('title')
    Registration
@endsection
@section('content')
    <!-- register -->
    <div class="sign-up-form">
        <h3 class="tittle">Registration <i class="glyphicon glyphicon-registration-mark"></i></h3>
        <div class="sign-up">
            <form action="{{asset('/registration')}}" method="post" onsubmit="return Registration()">
                @csrf
            <h3 class="tittle reg">Personal Information <i class="glyphicon glyphicon-user"></i></h3>
            <div class="sign-u">
                <div class="sign-up1">
                    <h4 class="a">First Name* :</h4>
                </div>
                <div class="sign-up2">
                        <input type="text" class="text"  name='first' id='first'  />
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="sign-u">
                <div class="sign-up1">
                    <h4 class="b">Last Name* :</h4>
                </div>
                <div class="sign-up2">
                        <input type="text" class="text"  name="last" id="last" />
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="sign-u">
                <div class="sign-up1">
                    <h4 class="c">Email Address* :</h4>
                </div>
                <div class="sign-up2">
                    <input type="text" class="text" name="email" id="email"  />
                </div>
                <div class="clearfix"> </div>
            </div>
            <h3 class="tittle reg">Login Information <i class="glyphicon glyphicon-log-in"></i></h3>
            <div class="sign-u">
                <div class="sign-up1">
                    <h4 class="d">Username* :</h4>
                </div>
                <div class="sign-up2">
                        <input type="text" class="text" name="username" id="username"   />
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="sign-u">
                <div class="sign-up1">
                    <h4 class="d">Password* :</h4>
                </div>
                <div class="sign-up2">
                    <input type="password" class="Password" name="pass" id="pass"  />
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="sign-u">
                <div class="sign-up1">
                    <h4>Confirm Password* :</h4>
                </div>
                <div class="sign-up2">
                    <input type="password" class="Password" name="confirm_pass" id="confirm_pass" />
                </div>
                <div class="clearfix"> </div>
            </div>
                <input type="submit" name="registration" value="Submit">
            </form>
            <div class="alert alert-danger"  id="reg_errors" ></div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('reg_error'))
                <div class="alert alert-warning">
                    {{ session('reg_error') }}
                </div>
                @endif
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        /**
         * @return {boolean}
         */
        function Users() {
            var errors_array = [];
            var first = $('#first').val();
            var first_reg = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/;

            if (!first_reg.test(first)) {
                errors_array.push('Bad first name');
            }

            var last = $('#last').val();
            var last_reg = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,14}$/;

            if (!last_reg.test(last)) {
                errors_array.push("Bad last name");
            }

            var email = $('#email').val();
            var email_reg = /^[a-zA-Z0-9-_.]+@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/;

            if (!email_reg.test(email)) {
                errors_array.push('Bad Email');
            }

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

            var confirm_pass = $('#confirm_pass').val();
            var confirm_pass_reg = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/;

            if(!confirm_pass_reg.test(confirm_pass)){
                errors_array.push('Bad Confirm Password');
            }

            if (confirm_pass !== pass) {
                alert("Passwords don't match");
                return false;
            }

            if (errors_array.length !== 0) {
                var error = '<ul>';
                for (var i in errors_array) {
                    error += "<li>" + errors_array[i] + "</li>";
                }
                error += '</ul>';
                $('#reg_errors').html(error).show();
                return false;
            }
            else {

                return true;
            }

        }


    </script>
    @endsection
