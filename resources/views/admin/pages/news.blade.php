@extends('admin.layout.backEnd')

@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    News</div>
                @if(session('update_news_success'))
                    <div class="alert alert-success">
                        {{session('update_news_success')}}
                    </div>
                @endif
                @if(session('update_news_error'))
                    <div class="alert alert-danger">
                        {{session('update_news_error')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Headline</th>
                                <th>Small picture</th>
                                <th>Date Published</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($news as $post)
                                <tbody>
                                <td>{{$post->headline}}</td>
                                <td><img src="{{asset($post->small_picture)}}"  alt="{{$post->alt}}"></td>
                                <td>{{date('M d Y',strtotime($post->created_at))}}</td>
                                <td><a href="{{route('admin_news.edit',['id' => $post->id ])}}" style="color: green;"><i class="fas fa-exchange-alt"></i></a></td>
                                <td><a href="" style="color: red;" onclick="deleteNews({{$post->id}})"> <i class="fas fa-trash-alt"></i></a></td>
                                </tbody>
                            @endforeach
                        </table>
                        @if(session('insert_post_success'))
                            <div class="alert alert-success">
                                {{session('insert_post_success')}}
                            </div>
                        @endif
                        @if(session('insert_post_error'))
                            <div class="alert alert-danger">
                                {{session('insert_post_error')}}
                            </div>
                        @endif
                    </div>
                    {{--{{$news->links()}}--}}
                    <button name="insert_news" class="btn btn-warning" onclick="showForm()">Insert</button>
                    <div id="form_show" style="display: none;">
                        <form  action="{{route('admin_news.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Headline</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Text</label><br/>
                                <textarea name="text" cols="200"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control" id="picture" name="picture" aria-describedby="emailHelp" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select class="custom-select" name="catId">
                                    <option value="0">Select</option>
                                    @foreach($category as $r)
                                        <option value="{{$r->id_cat}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
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
        function deleteNews(id) {
            $.ajax({
                type:"GET",
                url:'/admin_news/'+id+'/delete',
                dataType:'json',
                success:function(){
                },
                error:function () {
                }
            });
        }
    </script>
    @endsection
