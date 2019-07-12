@extends('layouts.frontEnd')

@section('title')
    Profile
    @endsection
@section('script')
    @parent
    @endsection

@section('profile')
    {{--{{dd($commmented_views)}}--}}


<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{asset(session('user')->profile_pic)}}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{session('user')->username}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-success btn-sm" id="btn_edit_pic">Edit Picture</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="#" class="viewed">
                                <i class="glyphicon glyphicon-home"></i>
                                Viewed Posts </a>
                        </li>
                        <li>
                            <a href="#" class="prof_settings">
                                <i class="glyphicon glyphicon-user"></i>
                                Account Settings </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success_edit'))
                    <div class="alert alert-success">
                        {{session('success_edit')}}
                    </div>
                @endif
                @if(session('failed_edit'))
                    <div class="alert alert-danger">
                        {{session('failed_edit')}}
                    </div>
                @endif
            <div class="profile-content">
                {{--EDIT PICTURE--}}
                <div id="edit_pic" style="display: none; margin-bottom: 30px;">
                    <h3>Edit picture</h3>
                    <br>
                        <form action="{{route('edit_pic',['id' => session('user')->UserId])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <p>Image</p>
                            <input type="file" id="edit_picture" name="edit_picture"\>
                            <input type="submit" id="btnEditPic" name="btnEditPic" value="Edit" class="btn btn-success btn-sm"/>
                        </form>

                </div>
                @if($commmented_views->count() == 0)
                <div id="viewed_posts">
                    <h3>Commented Posts</h3>
                    <br>
                    You didn't comment any posts so far
                    <br>
                    <a href="{{asset('/')}}" class="btn btn-success btn-sm">Home Page</a>
                </div>
                @else
                    <h3>Commented Posts</h3>
                    <div class="container_com_post">
                        <div class="row">
                            @foreach($commmented_views as $com_view)
                            <div class="col-sm-4" style="text-align: center;">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset($com_view->small_picture)}}" alt="{{$com_view->alt}}" width="150">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{$com_view->headline}}</h5>
                                        <a href="{{route('single_post',['id' =>$com_view->id_p,'user_id'=>$com_view->id_u])}}" class="btn btn-success">View Post</a>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                        </div>
                                                    {{$commmented_views->links()}}
                    </div>


                @endif
                <div id="profile_settings" style="display: none; margin-top: 20px">
                            <h3>Account Settings</h3>
                            <br>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control-plaintext" id="profile_first" name="first_name" value="{{session('user')->first_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control-plaintext" id="profile_last"  name="last_name"  value="{{session('user')->last_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control-plaintext" id="profile_email"  name="email"  value="{{session('user')->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control-plaintext" id="profile_username"  name="username"  value="{{session('user')->username}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button name="profile_edit" class="btn btn-success btn-sm" onclick="editProfile({{session('user')->UserId}})">Edit Profile</button>
                            </div>
                        </div>
                        <div id="ajax_ispis"></div>

                </div>
            </div>
        </div>
    </div>
</div>
    @endsection

@section('script')
    @parent
    <script type="text/javascript">



        function editProfile(id){

            var first_name = $('#profile_first').val();
            var last_name = $('#profile_last').val();
            var email = $('#profile_email').val();
            var username = $('#profile_username').val();


            $.ajax({

                type:'POST',
                url:"/profile/"+id+"/edit",
                data:{
                    first_name:first_name,
                    last_name:last_name,
                    email:email,
                    username:username
                },
                dataType:'json',
                success:function (data) {

                    $('#profile_first').val(first_name);
                    $('#profile_last').val(last_name);
                    $('#profile_email').val(email);
                    $('#profile_username').val(username);
                    alert(data.msg);

                },
                error:function (xhr,Status,ErrMsg) {

                    let errors = JSON.parse(xhr.responseText).errors;

                    let status = xhr.status;

                    if(status == 422){

                        var ispis = "<ul>";
                      for(var i in errors){

                        ispis += '<li>'+errors[i]+'</li>';
                      }
                      ispis +='</ul>';

                      $('#ajax_ispis').html(ispis);

                    }else{

                        alert('Application is not working, please come back later');

                    }

                }
            });
        }





        $('li > a').click(function() {
            $('li').removeClass();
            $(this).parent().addClass('active');
        });

        $('#btn_edit_pic').click(function(){

            $('#edit_pic').show();
            $('#viewed_posts').hide();
            $('#profile_settings').hide();

        });

        $('.viewed').click(function () {

            $('#edit_pic').hide();
            $('#viewed_posts').show();
            $('#profile_settings').hide();
        });

        $('.prof_settings').click(function () {

            $('#edit_pic').hide();
            $('#viewed_posts').hide();
            $('#profile_settings').show();
        });






    </script>
    @endsection