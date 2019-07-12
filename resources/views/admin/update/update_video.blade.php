@extends('admin.layout.backEnd')

@section('video_update_form')

    <div class="card-body">

        <form  action="{{route('admin_video.update',['id' => $one_video->id])}}" method="POST" enctype="multipart/form-data" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="{{$one_video->title}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="url" class="form-control" id="video_url" name="video_url" aria-describedby="emailHelp" value="{{$one_video->url}}">
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
