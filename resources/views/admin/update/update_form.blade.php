@extends('admin.layout.backEnd')

@section('update_form')

    <div class="card-body">

    <form  action="{{route('users.update',['id' => $one_user->UserId])}}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="emailHelp" value="{{$one_user->first_name}}" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Last Name</label>
            <input type="text" class="form-control" id="LastName" name="LastName" value="{{$one_user->last_name}}" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{$one_user->email}}" >

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="{{$one_user->username}}" >

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Role</label>
            <select class="custom-select" name="role">
                <option value="0">Select</option>
                @foreach($role as $r)
                    @if($r->id_role == $one_user->role_id)
                    <option value="{{$r->id_role}}" selected>{{$r->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" class="form-control" id="picture" name="picture" aria-describedby="emailHelp" >
            <img src="{{asset($one_user->profile_pic)}}" alt="profilna_slika" width="100px" height="100px"/>
        </div>

        <input type="submit" name="sub_user" class="btn btn-primary" value="Submit"/>
    </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @endsection

{{--@section('script')--}}
    {{--@parent--}}

    {{--<script type="text/javascript">--}}
        {{--function Config() {--}}

            {{--var confirm_pass = $('#confirm_pass').val();--}}

            {{--var pass = $('#password').val();--}}

            {{--if (confirm_pass !== pass) {--}}

                {{--alert("Passwords don't match");--}}
                {{--return false;--}}
            {{--}else{--}}

                {{--return true;--}}
            {{--}--}}



        {{--}--}}
    {{--</script>--}}
    {{--@endsection--}}