@extends('admin.layout.backEnd')

@section('content')
    <div class="card-body">
        <form action="{{route('admin_category.update',['id' => $single_category['id']])}}" method="POST" enctype="multipart/form-data" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Category Name</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="{{$single_category['name']}}">
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
