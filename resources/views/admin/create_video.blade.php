@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
<form action="{{route('video.store')}}" method="POST">
    @csrf
<input type="text" name="title" />
    <input type="url" name="video_url"/>
    <input type="submit" name="video_submit" value="Submit"/>
</form>