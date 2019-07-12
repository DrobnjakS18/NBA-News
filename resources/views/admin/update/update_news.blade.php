@extends('admin.layout.backEnd')

@section('news_update_form')

    <div class="card-body">

        <form  action="{{route('admin_news.update',['id' => $one_post->id])}}" method="POST" enctype="multipart/form-data" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Headline</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="{{$one_post->headline}}"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Text</label><br/>
                <textarea name="text" cols="200">{{$one_post->text}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" class="form-control" id="picture" name="picture" aria-describedby="emailHelp" >
                <img src="{{asset($one_post->small_picture)}}" alt="{{$one_post->alt}}" />
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select class="custom-select" name="catId">
                    <option value="0">Select</option>
                    @foreach($category as $r)
                        <option value="{{$r->id_cat}}" @if($one_post->cat_id == $r->id_cat)selected @endif>{{$r->name}}</option>
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
@endsection
