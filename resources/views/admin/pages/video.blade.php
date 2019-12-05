@extends('admin.layout.backEnd')

@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
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
                            @foreach($videos as $video)
                                <tbody>
                                <td>{{$video['title']}}</td>
                                <td><iframe src="https://www.youtube.com/embed/{{$video['url']}}"></iframe></td>
                                <td><a class="btn btn-success" href="{{route('admin_video.edit',['id' => $video['id'] ])}}" style="color: green;"><i class="fas fa-exchange-alt" style="color: white"></i></a></td>
                                <td> <button class="delete-video btn btn-danger" data-id="{{$video['id']}}"><i class="fas fa-trash-alt"></i></button></td>
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
                                <label for="video_id">URL</label>
                                <input type="text" class="form-control" id="video_id" name="video_id" aria-describedby="emailHelp" >
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
    </div>
    @endsection
@section('scripts')
    <script type="text/javascript">
        $(".delete-video").click(function(){
            var id = $(this).data("id");
            $.ajax(
                {
                    url: "admin_video/"+id,
                    type: 'DELETE',
                    dataType: "json",
                    data: {
                        "id": id,
                    },
                    success: function (data)
                    {
                        alert(data.success);
                    }
                });
        });
    </script>
@endsection
