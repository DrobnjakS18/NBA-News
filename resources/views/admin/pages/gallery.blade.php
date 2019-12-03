@extends('admin.layout.backEnd')

@section('gallery')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Gallery</div>
                @if(session('update_gallery_success'))
                    <div class="alert alert-success">
                        {{session('update_gallery_success')}}
                    </div>
                @endif
                @if(session('update_gallery_error'))
                    <div class="alert alert-danger">
                        {{session('update_gallery_error')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Small Picture</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($gallery as $pic)
                                <tbody>
                                <td>{{$pic['title']}}</td>
                                <td><img src="{{asset($pic['small_path'])}}" alt="{{$pic['alt']}}"/></td>
                                <td><a href="{{route('gallery.edit',['id' => $pic['id'] ])}}" style="color: green;"><i class="fas fa-exchange-alt"></i></a></td>
                                <td><a href="" style="color: red;" onclick="deleteGallery({{$pic['id']}})"> <i class="fas fa-trash-alt"></i></a></td>
                                </tbody>
                            @endforeach

                        </table>

                        @if(session('insert_gallery_success'))
                            <div class="alert alert-success">
                                {{session('insert_gallery_success')}}
                            </div>
                        @endif

                        @if(session('insert_gallery_error'))
                            <div class="alert alert-danger">
                                {{session('insert_gallery_error')}}
                            </div>
                        @endif
                    </div>

                    <button name="insert_gallery" class="btn btn-warning" onclick="showForm()">Insert</button>
                    <div id="form_show" style="display: none;">
                        <form  action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control" id="picture" name="picture" aria-describedby="emailHelp" >
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

@section('back_script')
    @parent
    <script type="text/javascript">
        function deleteGallery(id) {
            $.ajax({
                type:"GET",
                url:'/admin_gallery/'+id+'/delete',
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
