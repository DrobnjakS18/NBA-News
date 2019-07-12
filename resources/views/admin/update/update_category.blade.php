@extends('admin.layout.backEnd')

@section('cat_update_form')

    <div class="card-body">

        <form  action="{{route('admin_category.update',['id' => $one_cat->id_cat])}}" method="POST" enctype="multipart/form-data" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="{{$one_cat->name}}">
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