@extends('admin.layout.backEnd')

@section('content')
    <div class="card-body">
        <form  action="{{route('admin_video.update',['id' => $single_video['id']])}}" method="POST" enctype="multipart/form-data" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="{{$single_video['title']}}">
            </div>
            <div class="form-group">
                <label for="video_id">Youtube Video ID</label>
                <input type="text" class="form-control" id="video_id" name="video_id" aria-describedby="emailHelp" value="{{$single_video['url']}}">
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
