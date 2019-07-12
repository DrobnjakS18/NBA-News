
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
<form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
   @csrf
    Naziv
    <input type="text" name="title"/>
    Slika
    <input type="file" name="gallery_pic" />
    <input type="submit" name="subGallery" value="Submit"/>
</form>