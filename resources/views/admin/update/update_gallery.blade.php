@extends('admin.layout.backEnd')

@section('gallery_update_form')
    <div class="card-body">
        <form  action="{{route('gallery.update',['id' => $one_pic['id']])}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="{{$one_pic->title}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" class="form-control" id="picture" name="picture" aria-describedby="emailHelp" >
                <img src="{{asset($one_pic->small_path)}}" alt="profilna_slika" />
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
