@extends('admin.layout.backEnd')

@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Category</div>
                @if(session('update_category_success'))
                    <div class="alert alert-success">
                        {{session('update_category_success')}}
                    </div>
                @endif
                @if(session('update_category_error'))
                    <div class="alert alert-danger">
                        {{session('update_category_error')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($category as $cat)
                                <tbody>
                                <td>{{$cat->name}}</td>
                                <td><a href="{{route('admin_category.edit',['id' => $cat->id_cat ])}}" style="color: green;"><i class="fas fa-exchange-alt"></i></a></td>
                                <td><a href="" style="color: red;" onclick="deleteCat({{$cat->id_cat}})"> <i class="fas fa-trash-alt"></i></a></td>
                                </tbody>
                            @endforeach
                        </table>
                        @if(session('insert_category_success'))
                            <div class="alert alert-success">
                                {{session('insert_category_success')}}
                            </div>
                        @endif
                        @if(session('insert_category_error'))
                            <div class="alert alert-danger">
                                {{session('insert_category_error')}}
                            </div>
                        @endif
                    </div>
                    <button name="insert_gallery" class="btn btn-warning" onclick="showForm()">Insert</button>
                    <div id="form_show" style="display: none;">
                        <form  action="{{route('admin_category.store')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
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
        function deleteCat(id) {
            $.ajax({
                type:"GET",
                url:'/admin_category/'+id+'/delete',
                dataType:'json',
                success:function(){
                },
                error:function () {
                }
            });
        }
    </script>
@endsection
