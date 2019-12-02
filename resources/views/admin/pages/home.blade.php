@extends('admin.layout.backEnd')
@section('users')
    <div id="content-wrapper">

        <div class="container-fluid">


            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Users</div>
                @if(session('update_user_success'))
                    <div class="alert alert-success">
                        {{session('update_user_success')}}
                    </div>
                @endif
                @if(session('update_user_error'))
                    <div class="alert alert-danger">
                        {{session('update_user_error')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                            <tbody>
                                <td>{{$user['first_name']}}</td>
                                <td>{{$user['last_name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['username']}}</td>
                                <td><a href="{{route('users.edit',['id' => $user['id']])}}" style="color: green;"><i class="fas fa-exchange-alt"></i></a></td>
                                <td><a href="" style="color: red;" onclick="deleteUser({{ $user['id']}})"> <i class="fas fa-trash-alt"></i></a></td>
                            </tbody>
                            @endforeach

                        </table>
                        @if(session('insert_user_success'))
                            <div class="alert alert-success">
                            {{session('insert_user_success')}}
                            </div>
                        @endif
                        @if(session('insert_user_error'))
                            <div class="alert alert-danger">
                            {{session('insert_user_error')}}
                            </div>
                        @endif
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


                    <button name="insert_user" class="btn btn-warning" onclick="showForm()">Insert</button>
                    <div id="form_show" style="display: none;">
                        <form  action="{{route('users.store')}}" method="POST" onsubmit="return Config()">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input type="text" class="form-control" id="LastName" name="LastName">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" >

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" >

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" aria-describedby="emailHelp" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role</label>
                                <select class="custom-select" name="role">
                                    <option value="0">Select</option>
                                    @foreach($role as $r)
                                        <option value="{{$r['id_role']}}">{{$r['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" name="sub_user" class="btn btn-primary" value="Submit"/>
                        </form>

                    </div>


                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->
@endsection

@section('back_script')
    @parent

    <script type="text/javascript">


        function deleteUser(id) {

            $.ajax({
                type:"GET",
                url:'/users/'+id+'/delete',
                dataType:'json',
                success:function(){

                },
                error:function () {

                }
            });

        }




        function Config() {

            var confirm_pass = $('#confirm_pass').val();

            var pass = $('#password').val();

            if (confirm_pass !== pass) {

                alert("Passwords don't match");
                return false;
            }else{

                return true;
            }



        }


        function showForm() {

            $("#form_show").slideToggle('slow');

        }

    </script>



    @endsection
