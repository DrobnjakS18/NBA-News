@extends('admin.layout.backEnd')

@section('video')

    <div id="content-wrapper">

        <div class="container-fluid">


            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Video</div>
                @if(session('update_video_success'))
                    <div class="alert alert-success">
                        {{session('update_video_success')}}
                    </div>
                @endif
                @if(session('update_video_error'))
                    <div class="alert alert-danger">
                        {{session('update_video_error')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Video</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($video as $clip)
                                <tbody>
                                <td>{{$clip->title}}</td>
                                <td><iframe src="{{$clip->url}}"></iframe></td>
                                <td><a href="{{route('admin_video.edit',['id' => $clip->id ])}}" style="color: green;"><i class="fas fa-exchange-alt"></i></a></td>
                                <td><a href="" style="color: red;" onclick="deleteVideo({{$clip->id}})"> <i class="fas fa-trash-alt"></i></a></td>
                                </tbody>
                            @endforeach

                        </table>


                        @if(session('insert_video_success'))
                            <div class="alert alert-success">
                                {{session('insert_video_success')}}
                            </div>
                        @endif

                        @if(session('insert_video_error'))
                            <div class="alert alert-danger">
                                {{session('insert_video_error')}}
                            </div>
                        @endif
                    </div>

                    <button name="insert_gallery" class="btn btn-warning" onclick="showForm()">Insert</button>
                    <div id="form_show" style="display: none;">
                        <form  action="{{route('admin_video.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">URL</label>
                                <input type="url" class="form-control" id="video_url" name="video_url" aria-describedby="emailHelp" >
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
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    @endsection

@section('back_script')
    @parent
    <script type="text/javascript">

        function deleteVideo(id) {


            $.ajax({
                type:"GET",
                url:'/admin_video/'+id+'/delete',
                dataType:'json',
                success:function(){

                },
                error:function () {

                }
            });

        }



        function showForm() {


            $("#form_show").slideToggle('slow');

        }

    </script>
@endsection